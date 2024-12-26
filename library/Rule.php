<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

interface Rule
{
    public const TEMPLATE_STANDARD = '__standard__';

    public function evaluate(mixed $input): Result;

    public function getName(): ?string;

    public function setName(string $name): static;
}
