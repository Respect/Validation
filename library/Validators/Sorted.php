<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function array_values;
use function count;
use function is_array;
use function is_string;
use function str_split;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be sorted in ascending order',
    '{{subject}} must not be sorted in ascending order',
    self::TEMPLATE_ASCENDING,
)]
#[Template(
    '{{subject}} must be sorted in descending order',
    '{{subject}} must not be sorted in descending order',
    self::TEMPLATE_DESCENDING,
)]
final readonly class Sorted implements Validator
{
    public const string TEMPLATE_ASCENDING = '__ascending__';
    public const string TEMPLATE_DESCENDING = '__descending__';

    public const string ASCENDING = 'ASC';
    public const string DESCENDING = 'DESC';

    public function __construct(
        private string $direction,
    ) {
        if ($direction !== self::ASCENDING && $direction !== self::DESCENDING) {
            throw new InvalidValidatorException(
                'Direction should be either "%s" or "%s"',
                self::ASCENDING,
                self::DESCENDING,
            );
        }
    }

    public function evaluate(mixed $input): Result
    {
        $template = $this->direction === self::ASCENDING ? self::TEMPLATE_ASCENDING : self::TEMPLATE_DESCENDING;
        if (!is_array($input) && !is_string($input)) {
            return Result::failed($input, $this, [], $template);
        }

        $values = $this->getValues($input);
        $count = count($values);
        for ($position = 1; $position < $count; ++$position) {
            if (!$this->isSorted($values[$position], $values[$position - 1])) {
                return Result::failed($input, $this, [], $template);
            }
        }

        return Result::passed($input, $this, [], $template);
    }

    private function isSorted(mixed $current, mixed $last): bool
    {
        if ($this->direction === self::ASCENDING) {
            return $current > $last;
        }

        return $current < $last;
    }

    /**
     * @param string|mixed[] $input
     *
     * @return mixed[]
     */
    private function getValues(string|array $input): array
    {
        if (is_array($input)) {
            return array_values($input);
        }

        return str_split($input);
    }
}
