<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Message;

use Respect\Validation\Message\Renderer;
use Respect\Validation\Result;

final class TestingMessageRenderer implements Renderer
{
    public function render(Result $result): string
    {
        return $result->template;
    }
}
