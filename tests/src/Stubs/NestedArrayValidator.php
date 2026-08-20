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
final class NestedArrayValidator implements Validator
{
    /** @var array{0: array{0: string, 1: Attributes}} */
    private array $children;

    public function __construct()
    {
        $this->children = [['nested', new Attributes()]];
    }

    public function evaluate(mixed $input): Result
    {
        return (new AlwaysValid())->evaluate($input);
    }
}
