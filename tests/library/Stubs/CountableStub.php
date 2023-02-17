<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Countable;

/**
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 */
final class CountableStub implements Countable
{
    /**
     * @var int
     */
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function count(): int
    {
        return $this->value;
    }
}
