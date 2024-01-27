<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

final class Instance extends AbstractRule
{
    public function __construct(private string $instanceName)
    {
    }

    public function validate(mixed $input): bool
    {
        return $input instanceof $this->instanceName;
    }
}
