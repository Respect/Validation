<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Message;

use Respect\Stringifier\Handler;

use function print_r;
use function sprintf;

final class TestingHandler implements Handler
{
    public function handle(mixed $raw, int $depth): string|null
    {
        return sprintf('<%s:%d>', print_r($raw, true), $depth);
    }
}
