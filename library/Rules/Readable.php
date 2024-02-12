<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Psr\Http\Message\StreamInterface;
use Respect\Validation\Message\Template;
use SplFileInfo;

use function is_readable;
use function is_string;

#[Template(
    '{{name}} must be readable',
    '{{name}} must not be readable',
)]
final class Readable extends Simple
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
