<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use ReflectionProperty;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Attributes;
use Respect\Validation\Validators\Attributes\PropertyResolver;

use function array_values;

final class StubPropertyResolver implements PropertyResolver
{
    /** @var list<Validator> */
    private readonly array $validators;

    public function __construct(Validator ...$validators)
    {
        $this->validators = array_values($validators);
    }

    /** @return list<Validator> */
    public function resolve(ReflectionProperty $property, Attributes $attributes): array
    {
        return $this->validators;
    }
}
