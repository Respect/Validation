<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Factory;
use Respect\Validation\Validatable;

abstract class AbstractRule implements Validatable
{
    protected ?string $name = null;

    protected ?string $template = null;

    public function assert(mixed $input): void
    {
        if ($this->validate($input)) {
            return;
        }

        throw $this->reportError($input);
    }

    public function check(mixed $input): void
    {
        $this->assert($input);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param mixed[] $extraParameters
     */
    public function reportError(mixed $input, array $extraParameters = []): ValidationException
    {
        return Factory::getDefaultInstance()->exception($this, $input, $extraParameters);
    }

    public function setName(string $name): Validatable
    {
        $this->name = $name;

        return $this;
    }

    public function setTemplate(string $template): Validatable
    {
        $this->template = $template;

        return $this;
    }

    public function getTemplate(mixed $input): string
    {
        return $this->template ?? $this->getStandardTemplate($input);
    }

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return [];
    }

    protected function getStandardTemplate(mixed $input): string
    {
        return self::TEMPLATE_STANDARD;
    }

    public function __invoke(mixed $input): bool
    {
        return $this->validate($input);
    }
}
