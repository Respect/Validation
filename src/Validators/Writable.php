<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: v0idpwn <v0idpwn@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Psr\Http\Message\StreamInterface;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;
use SplFileInfo;

use function is_string;
use function is_writable;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be writable',
    '{{subject}} must not be writable',
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
