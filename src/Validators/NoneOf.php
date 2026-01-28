<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\IsValid;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validators\Core\Composite;

use function count;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must pass the rules',
    '{{subject}} must pass the rules',
    self::TEMPLATE_SOME,
)]
#[Template(
    '{{subject}} must pass all the rules',
    '{{subject}} must pass all the rules',
    self::TEMPLATE_ALL,
)]
final class NoneOf extends Composite implements IsValid
{
    public const string TEMPLATE_ALL = '__all__';
    public const string TEMPLATE_SOME = '__some__';

    public function evaluate(mixed $input): Result
    {
        $failedCount = 0;
        $children = [];
        foreach ($this->validators as $child) {
            $child = $child->evaluate($input)->withToggledModeAndValidation();
            $children[] = $child;
            if ($child->hasPassed) {
                continue;
            }

            $failedCount++;
        }

        return Result::of(
            $failedCount === 0,
            $input,
            $this,
            [],
            count($children) === $failedCount ? self::TEMPLATE_ALL : self::TEMPLATE_SOME,
        )->withChildren(...$children);
    }

    public function isValid(mixed $input): bool
    {
        foreach ($this->validators as $validator) {
            if ($validator instanceof IsValid) {
                return !$validator->isValid($input);
            }

            if ($validator->evaluate($input)->hasPassed) {
                return false;
            }
        }

        return true;
    }
}
