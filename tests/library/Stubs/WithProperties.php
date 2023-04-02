<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

final class WithProperties
{
    public string $public = 'public';

    protected string $protected = 'protected';

    private string $private = 'private'; // @phpstan-ignore-line
}
