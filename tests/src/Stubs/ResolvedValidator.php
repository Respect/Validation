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

#[Attribute(Attribute::TARGET_PROPERTY)]
final class ResolvedValidator implements Validator
{
    private readonly ResolvedDependency $dependency;

    public function __construct(ResolvedDependency|null $dependency = null)
    {
        $this->dependency = $dependency ?? new ResolvedDependency('not resolved');
    }

    public function evaluate(mixed $input): Result
    {
        return Result::of($input === $this->dependency->expected, $input, $this);
    }
}
