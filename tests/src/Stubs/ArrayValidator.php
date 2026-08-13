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

#[Attribute(Attribute::TARGET_PROPERTY)]
final class ArrayValidator implements Validator
{
    /** @var array{0: string, self: array<mixed>} */
    private array $children;

    public function __construct()
    {
        $children = ['value'];
        $children['self'] = &$children;

        $this->children = $children;
    }

    public function evaluate(mixed $input): Result
    {
        return (new AlwaysValid())->evaluate($input);
    }
}
