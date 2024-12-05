<?php

declare(strict_types=1);

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

namespace Respect\Validation\Message\Translator;

use Respect\Validation\Message\Translator;

final class DummyTranslator implements Translator
{
    public function translate(string $message): string
    {
        return $message;
    }
}
