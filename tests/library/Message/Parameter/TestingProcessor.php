<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Message\Parameter;

use Respect\Validation\Message\Parameter\Processor;

use function json_encode;
use function sprintf;

final class TestingProcessor implements Processor
{
    public function process(string $name, mixed $value, ?string $modifier = null): string
    {
        if ($modifier !== null) {
            return sprintf('%s(<%s:%s>)', $modifier, $name, $modifier);
        }

        return sprintf('<%s:%s>', $name, json_encode($value));
    }
}
