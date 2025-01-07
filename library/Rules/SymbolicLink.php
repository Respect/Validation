<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;
use SplFileInfo;

use function is_link;
use function is_string;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a symbolic link',
    '{{name}} must not be a symbolic link',
)]
final class SymbolicLink extends Simple
{
    public function isValid(mixed $input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $input->isLink();
        }

        return is_string($input) && is_link($input);
    }
}
