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
use Respect\Validation\Helpers\CanValidateDateTime;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Standard;

use function array_map;
use function in_array;
use function ucfirst;

#[Template(
    'The number of {{type|trans}} between now and',
    'The number of {{type|trans}} between now and',
    self::TEMPLATE_STANDARD
)]
#[Template(
    'The number of {{type|trans}} between {{now|raw}} and',
    'The number of {{type|trans}} between {{now|raw}} and',
    self::TEMPLATE_CUSTOMIZED
)]
#[Template(
    'For comparison with {{now|raw}}, {{name}} must be a valid datetime in the format {{sample|raw}}',
    'For comparison with {{now|raw}}, {{name}} must not be a valid datetime in the format {{sample|raw}}',
    self::TEMPLATE_WRONG_FORMAT
)]
final class DateTimeDiff extends Standard
{
    use CanValidateDateTime;

    public const TEMPLATE_CUSTOMIZED = '__customized__';
    public const TEMPLATE_WRONG_FORMAT = '__wrong_format__';

    /** @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type */
    public function __construct(
        private readonly string $type,
        private readonly Rule $rule,
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
    }

    public function evaluate(mixed $input): Result
    {
        $now = $this->now ?? new DateTimeImmutable();
        $compareTo = $this->createDateTimeObject($input);
        if ($compareTo === null) {
            $parameters = ['sample' => $now->format($this->format ?? 'c'), 'now' => $this->nowParameter($now)];

            return Result::failed($input, $this, $parameters, self::TEMPLATE_WRONG_FORMAT)
                ->withId('dateTimeDiff' . ucfirst($this->rule->evaluate($input)->id));
        }

        return $this->enrichResult(
            $this->nowParameter($now),
            $input,
            $this->rule->evaluate($this->comparisonValue($now, $compareTo))
        );
    }

    private function enrichResult(string $now, mixed $input, Result $result): Result
    {
        $name = $input instanceof DateTimeInterface ? $input->format('c') : $input;

        if (!$result->allowsSubsequent()) {
            return $result
                ->withNameIfMissing($name)
                ->withChildren(
                    ...array_map(fn(Result $child) => $this->enrichResult($now, $input, $child), $result->children)
                );
        }

        $parameters = ['type' => $this->type, 'now' => $now];
        $template = $now === 'now' ? self::TEMPLATE_STANDARD : self::TEMPLATE_CUSTOMIZED;

        return (new Result($result->isValid, $input, $this, $parameters, $template, id: $result->id))
            ->withPrefixedId('dateTimeDiff')
            ->withSubsequent($result->withNameIfMissing($name));
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
