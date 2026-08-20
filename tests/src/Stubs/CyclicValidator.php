<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Respect\Validation\Validators\AlwaysValid;
use Respect\Validation\Validators\Attributes;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class CyclicValidator implements Validator
{
    /** @var array{self, Attributes, string} */
    private array $children;

    public function __construct()
    {
        $this->children = [$this, new Attributes(), 'cyclic'];
    }

    public function evaluate(mixed $input): Result
    {
        return (new AlwaysValid())->evaluate($input);
    }
}
