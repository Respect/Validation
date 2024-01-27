<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Psr\Http\Message\StreamInterface;
use SplFileInfo;

use function is_readable;
use function is_string;

final class Readable extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $input->isReadable();
        }

        if ($input instanceof StreamInterface) {
            return $input->isReadable();
        }

        return is_string($input) && is_readable($input);
    }
}
