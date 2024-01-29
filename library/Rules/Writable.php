<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Psr\Http\Message\StreamInterface;
use Respect\Validation\Attributes\Template;
use SplFileInfo;

use function is_string;
use function is_writable;

#[Template(
    '{{name}} must be writable',
    '{{name}} must not be writable',
)]
final class Writable extends AbstractRule
{
    public function validate(mixed $input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $input->isWritable();
        }

        if ($input instanceof StreamInterface) {
            return $input->isWritable();
        }

        return is_string($input) && is_writable($input);
    }
}
