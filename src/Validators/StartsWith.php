<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Marcelo Araujo <msaraujo@php.net>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function count;
use function is_array;
use function is_string;
use function mb_strpos;
use function reset;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must start with {{startValue}}',
    '{{subject}} must not start with {{startValue}}',
)]
#[Template(
    '{{subject}} must start with {{startValues|list:or}}',
    '{{subject}} must not start with {{startValues|list:or}}',
    self::TEMPLATE_MULTIPLE_VALUES,
)]
final readonly class StartsWith implements Validator
{
    public const string TEMPLATE_MULTIPLE_VALUES = '__multiple_values__';

    /** @var non-empty-array<mixed> */
    private array $startValues;

    public function __construct(
        mixed $startValue,
        mixed ...$startValues,
    ) {
        $this->startValues = [$startValue, ...$startValues];
    }

    public function evaluate(mixed $input): Result
    {
        $template = self::TEMPLATE_STANDARD;
        $parameters = [
            'startValue' => $this->startValues[0],
            'startValues' => $this->startValues,
        ];

        if (count($this->startValues) > 1) {
            $template = self::TEMPLATE_MULTIPLE_VALUES;
        }

        return Result::of($this->validateIdentical($input), $input, $this, $parameters, $template);
    }

    protected function validateIdentical(mixed $input): bool
    {
        foreach ($this->startValues as $startValue) {
            if (is_array($input) && reset($input) === $startValue) {
                return true;
            }

            if (is_string($input) && is_string($startValue) && mb_strpos($input, $startValue) === 0) {
                return true;
            }
        }

        return false;
    }
}
