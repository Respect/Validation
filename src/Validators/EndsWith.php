<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Hugo Hamon <hugo.hamon@sensiolabs.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function count;
use function end;
use function is_array;
use function is_string;
use function mb_strlen;
use function mb_strrpos;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must end with {{endValue}}',
    '{{subject}} must not end with {{endValue}}',
)]
#[Template(
    '{{subject}} must end with {{endValues|list:or}}',
    '{{subject}} must not end with {{endValues|list:or}}',
    self::TEMPLATE_MULTIPLE_VALUES,
)]
final readonly class EndsWith implements Validator
{
    public const string TEMPLATE_MULTIPLE_VALUES = '__multiple_values__';

    /** @var non-empty-array<mixed> */
    private array $endValues;

    public function __construct(
        mixed $endValue,
        mixed ...$endValues,
    ) {
        $this->endValues = [$endValue, ...$endValues];
    }

    public function evaluate(mixed $input): Result
    {
        $template = self::TEMPLATE_STANDARD;
        $parameters = [
            'endValue' => $this->endValues[0],
            'endValues' => $this->endValues,
        ];

        if (count($this->endValues) > 1) {
            $template = self::TEMPLATE_MULTIPLE_VALUES;
        }

        return Result::of($this->validateIdentical($input), $input, $this, $parameters, $template);
    }

    private function validateIdentical(mixed $input): bool
    {
        foreach ($this->endValues as $endValue) {
            if (is_array($input) && end($input) === $endValue) {
                return true;
            }

            // ensure both operands are strings before using mb_ functions
            if (
                is_string($input) && is_string($endValue)
                && mb_strrpos($input, $endValue) === mb_strlen($input) - mb_strlen($endValue)
            ) {
                return true;
            }
        }

        return false;
    }
}
