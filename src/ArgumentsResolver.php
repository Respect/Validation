<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use ReflectionFunctionAbstract;

interface ArgumentsResolver
{
    /**
     * Augments the given arguments with values for the parameters they do not already fill.
     *
     * @param array<int|string, mixed> $arguments
     *
     * @return array<int|string, mixed>
     */
    public function resolve(ReflectionFunctionAbstract $function, array $arguments): array;
}
