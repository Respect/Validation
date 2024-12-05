<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ReflectionClass;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Validator;

/**
 * @deprecated Use {@see Simple} instead.
 */
abstract class AbstractRule implements Rule
{
    private ?string $name = null;

    private ?string $template = null;

    /**
     * @deprecated Calling `validate()` directly is deprecated, please use the `Validator::isValid()` instead.
     */
    abstract public function validate($input): bool;

    public function evaluate(mixed $input): Result
    {
        return new Result(
            $this->validate($input),
            $input,
            $this,
            $this->extractPropertiesValues(),
            $this->template ?? '{{name}} must be valid',
        );
    }

    /**
     * @deprecated Calling `assert()` directly is deprecated, please use the `Validator::assert()` instead.
     */
    public function assert($input): void
    {
        Validator::create($this)->assert($input);
    }

    /**
     * @deprecated Calling `check()` directly is deprecated, please use the `Validator::assert()` instead.
     */
    public function check($input): void
    {
        Validator::create($this)->assert($input);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(string $template): static
    {
        $this->template = $template;

        return $this;
    }

    /** @return array<string, mixed> */
    private function extractPropertiesValues(): array
    {
        $reflection ??= new ReflectionClass($this);
        $values = [];
        foreach ($reflection->getProperties() as $property) {
            $propertyValue = $property->getValue($this);
            if ($propertyValue === null) {
                continue;
            }

            $values[$property->getName()] = $propertyValue;
        }

        return $values;
    }
}
