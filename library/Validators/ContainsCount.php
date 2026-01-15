<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function array_reduce;
use function is_array;
use function is_scalar;
use function mb_strtolower;
use function mb_substr_count;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must contain {{containsValue}} {{count}} time(s)',
    '{{subject}} must not contain {{containsValue}} {{count}} time(s)',
    self::TEMPLATE_TIMES,
)]
#[Template(
    '{{subject}} must contain {{containsValue}} only once',
    '{{subject}} must not contain {{containsValue}} only once',
    self::TEMPLATE_ONCE,
)]
final readonly class ContainsCount implements Validator
{
    public const string TEMPLATE_TIMES = '__times__';
    public const string TEMPLATE_ONCE = '__once__';

    public function __construct(
        private mixed $containsValue,
        private int $count,
        private bool $identical = false,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = [
            'containsValue' => $this->containsValue,
            'count' => $this->count,
        ];

        $template = $this->count === 1 ? self::TEMPLATE_ONCE : self::TEMPLATE_TIMES;

        if (is_array($input)) {
            return Result::of(
                $this->countArrayOccurrences($input) === $this->count,
                $input,
                $this,
                $parameters,
                $template,
            );
        }

        if (!is_scalar($input) || !is_scalar($this->containsValue)) {
            return Result::failed($input, $this, $parameters, $template);
        }

        $needle = (string) $this->containsValue;

        if ($needle === '') {
            return Result::failed($input, $this, $parameters, $template);
        }

        return Result::of(
            $this->countStringOccurrences((string) $input, $needle) === $this->count,
            $input,
            $this,
            $parameters,
            $template,
        );
    }

    /** @param array<mixed> $input */
    private function countArrayOccurrences(array $input): int
    {
        return array_reduce(
            $input,
            $this->identical ? function (int $carry, mixed $item): int {
                return $carry + ($item === $this->containsValue ? 1 : 0);
            } : function (int $carry, mixed $item): int {
                return $carry + ($item == $this->containsValue ? 1 : 0);
            },
            0,
        );
    }

    private function countStringOccurrences(string $haystack, string $needle): int
    {
        if ($this->identical) {
            return mb_substr_count($haystack, $needle);
        }

        return mb_substr_count(mb_strtolower($haystack), mb_strtolower($needle));
    }
}
