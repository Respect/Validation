<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Exceptions\ValidationException;

interface Validatable extends Rule
{
    public function assert(mixed $input): void;

    public function check(mixed $input): void;

    /**
     * @param mixed[] $extraParameters
     */
    public function reportError(mixed $input, array $extraParameters = []): ValidationException;

    public function getTemplate(): ?string;

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array;

    public function validate(mixed $input): bool;
}
