<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Exceptions\ValidationException;

interface Validatable
{
    public const TEMPLATE_STANDARD = 'standard';

    public function assert(mixed $input): void;

    public function check(mixed $input): void;

    public function getName(): ?string;

    /**
     * @param mixed[] $extraParameters
     */
    public function reportError(mixed $input, array $extraParameters = []): ValidationException;

    public function setName(string $name): Validatable;

    public function setTemplate(string $template): Validatable;

    public function getTemplate(mixed $input): string;

    public function validate(mixed $input): bool;
}
