<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;

use function array_values;
use function count;
use function is_array;
use function is_string;
use function str_split;

#[Template(
    '{{name}} must be sorted in ascending order',
    '{{name}} must not be sorted in ascending order',
    self::TEMPLATE_ASCENDING,
)]
#[Template(
    '{{name}} must be sorted in descending order',
    '{{name}} must not be sorted in descending order',
    self::TEMPLATE_DESCENDING,
)]
final class Sorted extends Standard
{
    public const TEMPLATE_ASCENDING = '__ascending__';
    public const TEMPLATE_DESCENDING = '__descending__';

    public const ASCENDING = 'ASC';
    public const DESCENDING = 'DESC';

    public function __construct(
        private readonly string $direction
    ) {
        if ($direction !== self::ASCENDING && $direction !== self::DESCENDING) {
            throw new InvalidRuleConstructorException(
                'Direction should be either "%s" or "%s"',
                self::ASCENDING,
                self::DESCENDING
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
