<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Message;

use Respect\Validation\Message\ParameterStringifier;

use function json_encode;
use function sprintf;

final class TestingParameterStringifier implements ParameterStringifier
{
    public function stringify(string $name, mixed $value): string
    {
        return sprintf('<%s:%s>', $name, json_encode($value));
    }
}
