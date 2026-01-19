<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use DateTimeImmutable;
use DateTimeInterface;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Helpers\CanValidateDateTime;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Throwable;

use function in_array;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    'The number of {{type|trans}} between now and',
    'The number of {{type|trans}} between now and',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    'The number of {{type|trans}} between {{now}} and',
    'The number of {{type|trans}} between {{now}} and',
    self::TEMPLATE_CUSTOMIZED,
)]
#[Template(
    'For comparison with {{now|raw}}, {{subject}} must be a valid datetime',
    'For comparison with {{now|raw}}, {{subject}} must not be a valid datetime',
    self::TEMPLATE_NOT_A_DATE,
)]
#[Template(
    'For comparison with {{now|raw}}, {{subject}} must be a valid datetime in the format {{sample|raw}}',
    'For comparison with {{now|raw}}, {{subject}} must not be a valid datetime in the format {{sample|raw}}',
    self::TEMPLATE_WRONG_FORMAT,
)]
final readonly class DateTimeDiff implements Validator
{
    use CanValidateDateTime;

    public const string TEMPLATE_CUSTOMIZED = '__customized__';
    public const string TEMPLATE_NOT_A_DATE = '__not_a_date__';
    public const string TEMPLATE_WRONG_FORMAT = '__wrong_format__';

    /** @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type */
    public function __construct(
        private string $type,
        private Validator $validator,
        private string|null $format = null,
        private DateTimeImmutable|null $now = null,
    ) {
        $availableTypes = ['years', 'months', 'days', 'hours', 'minutes', 'seconds', 'microseconds'];
        if (!in_array($this->type, $availableTypes, true)) {
            throw new InvalidValidatorException(
                '"%s" is not a valid type of age (Available: %s)',
                $this->type,
                $availableTypes,
            );
        }
    }

    public function evaluate(mixed $input): Result
    {
        $now = $this->now ?? new DateTimeImmutable();
        $compareTo = $this->createDateTimeObject($input);
        if ($compareTo === null) {
            $template = $this->format === null ? self::TEMPLATE_NOT_A_DATE : self::TEMPLATE_WRONG_FORMAT;
            $parameters = ['sample' => $now->format($this->format ?? 'c'), 'now' => $this->nowParameter($now)];

            return Result::failed($input, $this, $parameters, $template)
                ->withId($this->validator->evaluate($input)->id->withPrefix('dateTimeDiff'));
        }

        $nowPlaceholder = $this->nowParameter($now);

        $result = $this->validator->evaluate($this->comparisonValue($now, $compareTo));

        return $result->asAdjacentOf(
            Result::of(
                $result->hasPassed,
                $input,
                $this,
                ['type' => $this->type, 'now' => $nowPlaceholder],
                $nowPlaceholder === 'now' ? self::TEMPLATE_STANDARD : self::TEMPLATE_CUSTOMIZED,
            ),
            'dateTimeDiff',
        );
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

    private function createDateTimeObject(mixed $input): DateTimeInterface|null
    {
        if ($input instanceof DateTimeInterface) {
            return $input;
        }

        if ($this->format === null) {
            try {
                return new DateTimeImmutable((string) $input);
            } catch (Throwable) {
                return null;
            }
        }

        $format = $this->getExceptionalFormats()[$this->format] ?? $this->format;
        $dateTime = DateTimeImmutable::createFromFormat($format, (string) $input);
        if ($dateTime === false) {
            return null;
        }

        return $dateTime;
    }
}
