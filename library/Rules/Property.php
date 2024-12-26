<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use ReflectionObject;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Nameable;
use Respect\Validation\Rules\Core\Wrapper;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class Property extends Wrapper
{
    public function __construct(
        private readonly string $propertyName,
        Rule $rule,
    ) {
        parent::__construct($rule);
    }

    public function evaluate(mixed $input): Result
    {
        $propertyExistsResult = (new PropertyExists($this->propertyName))->evaluate($input);
        if (!$propertyExistsResult->isValid) {
            return $propertyExistsResult->withName($this->getName());
        }

        return $this->rule
            ->evaluate($this->extractPropertyValue($input, $this->propertyName))
            ->withName($this->getName())
            ->withUnchangeableId($this->propertyName);
    }

    private function getName(): string
    {
        if ($this->rule instanceof Nameable) {
            return $this->rule->getName() ?? $this->propertyName;
        }

        return $this->propertyName;
    }

    private function extractPropertyValue(object $input, string $property): mixed
    {
        $reflectionObject = new ReflectionObject($input);
        $reflectionProperty = $reflectionObject->getProperty($property);

        return $reflectionProperty->isInitialized($input) ? $reflectionProperty->getValue($input) : null;
    }
}
