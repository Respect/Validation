<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTimeImmutable;
use DateTimeInterface;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Helpers\CanBindEvaluateRule;
use Respect\Validation\Helpers\CanExtractRules;
use Respect\Validation\Helpers\CanValidateDateTime;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;
use Respect\Validation\Validatable;

use function is_scalar;

#[Template(
    'The number of {{type|raw}} between {{now|raw}} and',
    'The number of {{type|raw}} between {{now|raw}} and',
)]
final class DateTimeDiff extends Standard
{
    use CanBindEvaluateRule;
    use CanValidateDateTime;
    use CanExtractRules;

    private readonly Validatable $rule;

    /** 
     * @param string $type DateInterval format examples:
     *  - 'y': years
     *  - 'm': months
     *  - 'd': days (within the same month or year)
     *  - 'days': full days (total difference in days)
     *  - 'h': hours
     *  - 'i': minutes
     *  - 's': seconds
     *  - 'f': microseconds
     * @param DateTimeImmutable|null $now The value that will be compared to the input
    */
    public function __construct(
        Validatable $rule,
        private readonly string $type = 'y',
        private readonly ?string $format = null,
        private readonly ?DateTimeImmutable $now = null,
    ) {
        if (!$this->isDateIntervalType($this->type)) {
            throw new InvalidRuleConstructorException(
                '"%s" is not a valid type of age (Available: %s)',
                $this->type,
                ['y', 'm', 'd', 'days', 'h', 'i', 's', 'f']
            );
        }
        $this->rule = $this->extractSiblingSuitableRule(
            $rule,
            new InvalidRuleConstructorException('DateTimeDiff must contain exactly one rule')
        );
    }

    public function evaluate(mixed $input): Result
    {
        $compareTo = $this->createDateTimeObject($input);
        if ($compareTo === null) {
            return Result::failed($input, $this);
        }

        $dateTimeResult = $this->bindEvaluate(
            binded: new DateTime($this->format), 
            binder: $this, 
            input: $input
        );
        if (!$dateTimeResult->isValid) {
            return $dateTimeResult;
        }

        $now = $this->now ?? new DateTimeImmutable();

        $nextSibling = $this->rule
            ->evaluate($this->comparisonValue($now, $compareTo))
            ->withNameIfMissing($input instanceof DateTimeInterface ? $input->format('c') : $input);

        $parameters = [
            'type' => $this->getTranslatedType($this->type), 
            'now' => $this->nowParameter($now)
        ];

        return (new Result($nextSibling->isValid, $input, $this, $parameters))->withNextSibling($nextSibling);
    }

    private function comparisonValue(DateTimeInterface $now, DateTimeInterface $compareTo)
    {
        return $compareTo->diff($now)->{$this->type};
    }

    private function nowParameter(DateTimeInterface $now): string
    {
        if ($this->format === null && $this->now === null) {
            return 'now';
        }

        if ($this->format === null) {
            return $now->format('Y-m-d H:i:s.u');
        }

        return $now->format($this->format);
    }

    private function createDateTimeObject(mixed $input): ?DateTimeInterface
    {
        if ($input instanceof DateTimeInterface) {
            return $input;
        }

        if (!is_scalar($input)) {
            return null;
        }

        if ($this->format === null) {
            return new DateTimeImmutable((string) $input);
        }

        $format = $this->getExceptionalFormats()[$this->format] ?? $this->format;
        $dateTime = DateTimeImmutable::createFromFormat($format, (string) $input);
        if ($dateTime === false) {
            return null;
        }

        return $dateTime;
    }

    private function getTranslatedType(string $type): string
    {
        return match ($type) {
            'y' => 'years',
            'm' => 'months',
            'd' => 'days',
            'days' => 'full days',
            'h' => 'hours',
            'i' => 'minutes',
            's' => 'seconds',
            'f' => 'microseconds',
        };
    }
}
