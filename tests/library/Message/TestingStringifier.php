<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Message;

use Respect\Stringifier\Stringifier;

use function print_r;
use function sprintf;

final class TestingStringifier implements Stringifier
{
    public function stringify(mixed $raw, int $depth): ?string
    {
        return sprintf('<%s:%d>', print_r($raw, true), $depth);
    }
}
