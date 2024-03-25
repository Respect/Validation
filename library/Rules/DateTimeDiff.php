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
use Respect\Validation\Helpers\CanExtractRules;
use Respect\Validation\Helpers\CanValidateDateTime;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;
use Respect\Validation\Validatable;

use function in_array;

#[Template(
    'The number of {{type|raw}} between {{now|raw}} and',
    'The number of {{type|raw}} between {{now|raw}} and',
)]
final class DateTimeDiff extends Standard
{
    use CanValidateDateTime;
    use CanExtractRules;

    private readonly Validatable $rule;

    /** @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type */
    public function __construct(
        private readonly string $type,
        Validatable $rule,
        private readonly ?string $format = null,
        private readonly ?DateTimeImmutable $now = null,
    ) {
        $availableTypes = ['years', 'months', 'days', 'hours', 'minutes', 'seconds', 'microseconds'];
        if (!in_array($this->type, $availableTypes, true)) {
            throw new InvalidRuleConstructorException(
                '"%s" is not a valid type of age (Available: %s)',
                $this->type,
                $availableTypes
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

        $now = $this->now ?? new DateTimeImmutable();
        $nextSibling = $this->rule
            ->evaluate($this->comparisonValue($now, $compareTo))
            ->withNameIfMissing($input instanceof DateTimeInterface ? $input->format('c') : $input);

        $parameters = ['type' => $this->type, 'now' => $this->nowParameter($now)];

        return (new Result($nextSibling->isValid, $input, $this, $parameters))->withNextSibling($nextSibling);
    }

    private function comparisonValue(DateTimeInterface $now, DateTimeInterface $compareTo): int|float
    {
        return match ($this->type) {
            'years' => $compareTo->diff($now)->y,
            'months' => $compareTo->diff($now)->m,
            'days' => $compareTo->diff($now)->d,
            'hours' => $compareTo->diff($now)->h,
            'minutes' => $compareTo->diff($now)->i,
            'seconds' => $compareTo->diff($now)->s,
            'microseconds' => $compareTo->diff($now)->f,
        };
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
}
