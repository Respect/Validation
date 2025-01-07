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

use function is_readable;
use function is_string;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be readable',
    '{{name}} must not be readable',
)]
final class Readable extends Simple
{
    public function isValid(mixed $input): bool
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
