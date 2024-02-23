<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use function array_map;
use function Respect\Stringifier\stringify;
use function sprintf;

final class InvalidRuleConstructorException extends ComponentException implements Exception
{
    public function __construct(string $message, mixed ...$arguments)
    {
        parent::__construct(sprintf($message, ...array_map(static fn($argument) => stringify($argument), $arguments)));
    }
}
