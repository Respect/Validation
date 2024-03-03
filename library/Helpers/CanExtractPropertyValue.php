<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use ReflectionObject;

trait CanExtractPropertyValue
{
    public function extractPropertyValue(object $input, string $property): mixed
    {
        $reflectionObject = new ReflectionObject($input);
        $reflectionProperty = $reflectionObject->getProperty($property);

        return $reflectionProperty->isInitialized($input) ? $reflectionProperty->getValue($input) : null;
    }
}
