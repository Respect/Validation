<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Hugo Hamon <hugo.hamon@sensiolabs.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class When implements Validator
{
    public function __construct(
        private Validator $when,
        private Validator $then,
        private Validator $else = new Templated(AlwaysInvalid::TEMPLATE_SIMPLE, new AlwaysInvalid()),
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $whenResult = $this->when->evaluate($input);
        if ($whenResult->hasPassed) {
            return $this->then->evaluate($input);
        }

        return $this->else->evaluate($input);
    }
}
