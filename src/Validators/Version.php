<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function is_string;
use function preg_match;

/** @see http://semver.org/ */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a version number',
    '{{subject}} must not be a version number',
)]
final class Version extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return preg_match('/^[0-9]+\.[0-9]+\.[0-9]+([+-][^+-][0-9A-Za-z-.]*)?$/', $input) > 0;
    }
}
