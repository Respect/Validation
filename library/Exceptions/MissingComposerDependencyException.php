<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use function implode;
use function sprintf;

final class MissingComposerDependencyException extends ComponentException implements Exception
{
    public function __construct(string $message, mixed ...$dependencies)
    {
        parent::__construct(sprintf(
            '%s. Run `composer require %s` to fix this issue.',
            $message,
            implode(' ', $dependencies),
        ));
    }
}
