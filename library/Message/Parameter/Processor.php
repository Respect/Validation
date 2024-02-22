<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Parameter;

interface Processor
{
    public function process(string $name, mixed $value, ?string $modifier = null): string;
}
