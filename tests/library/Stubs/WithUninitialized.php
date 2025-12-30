<?php

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

final class WithUninitialized
{
    public string $initialized = 'foo';

    public string $uninitialized;
}
