<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Attributes;

use ReflectionProperty;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Attributes;

/**
 * Resolves validators from properties.
 */
interface PropertyResolver
{
    /** @return array<Validator> */
    public function resolve(ReflectionProperty $property, Attributes $attributes): array;
}
