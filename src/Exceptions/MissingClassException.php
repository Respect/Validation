<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use Psr\Container\NotFoundExceptionInterface;

final class MissingClassException extends ComponentException implements Exception, NotFoundExceptionInterface
{
}
