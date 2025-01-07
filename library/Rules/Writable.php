<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Psr\Http\Message\StreamInterface;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;
use SplFileInfo;

use function is_string;
use function is_writable;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be writable',
    '{{name}} must not be writable',
)]
final class Writable extends Simple
{
    public function isValid(mixed $input): bool
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
