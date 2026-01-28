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
use Respect\Validation\Validator;
use Respect\Validation\Validators\Core\Composite;

use function array_map;
use function array_reduce;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must pass at least one of the rules',
    '{{subject}} must pass at least one of the rules',
)]
final class AnyOf extends Composite implements IsValid
{
    public function evaluate(mixed $input): Result
    {
        $children = array_map(static fn(Validator $validator) => $validator->evaluate($input), $this->validators);
        $valid = array_reduce(
            $children,
            static fn(bool $carry, Result $result) => $carry || $result->hasPassed,
            false,
        );

        return Result::of($valid, $input, $this)->withChildren(...$children);
    }

    public function isValid(mixed $input): bool
    {
        foreach ($this->validators as $validator) {
            if ($validator instanceof IsValid) {
                if ($validator->isValid($input)) {
                    return true;
                }

                continue;
            }

            if ($validator->evaluate($input)->hasPassed) {
                return true;
            }
        }

        return false;
    }
}
