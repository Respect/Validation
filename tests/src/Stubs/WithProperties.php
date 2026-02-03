<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

final class WithProperties
{
    public const string PUBLIC_VALUE = 'public';
    public const string PROTECTED_VALUE = 'protected';
    public const string PRIVATE_VALUE = 'private';

    public string $public = self::PUBLIC_VALUE;

    protected string $protected = self::PROTECTED_VALUE;

    private string $private = self::PRIVATE_VALUE; // @phpstan-ignore-line
}
