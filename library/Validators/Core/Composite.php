<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use Respect\Validation\Validator;

use function array_merge;

abstract class Composite implements Validator
{
    /** @var non-empty-array<Validator> */
    protected readonly array $validators;

    public function __construct(Validator $validator1, Validator $validator2, Validator ...$validators)
    {
        $this->validators = array_merge([$validator1, $validator2], $validators);
    }

    /** @return non-empty-array<Validator> */
    public function getValidators(): array
    {
        return $this->validators;
    }
}
