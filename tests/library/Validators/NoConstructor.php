<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Validators;

use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

#[Template(
    '{{subject}} must be a no-constructor validator',
    '{{subject}} must not be a no-constructor validator',
)]
final class NoConstructor extends Simple
{
    public function isValid(mixed $input): bool
    {
        // Accept everything for test purposes
        return true;
    }
}
