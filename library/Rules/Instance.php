<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

#[Template(
    '{{name}} must be an instance of {{instanceName}}',
    '{{name}} must not be an instance of {{instanceName}}',
)]
final class Instance extends AbstractRule
{
    public function __construct(
        private readonly string $instanceName
    ) {
    }

    public function validate(mixed $input): bool
    {
        return $input instanceof $this->instanceName;
    }

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return ['instanceName' => $this->instanceName];
    }
}
