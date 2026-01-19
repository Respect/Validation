<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
 * SPDX-FileContributor: Diego Oliveira <contato@diegoholiveira.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Aleksandr Gorshkov <mazanax@yandex.ru>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function is_scalar;
use function mb_strlen;
use function preg_replace;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid IMEI number',
    '{{subject}} must not be a valid IMEI number',
)]
final class Imei extends Simple
{
    private const int IMEI_SIZE = 15;

    public function isValid(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $numbers = (string) preg_replace('/\D/', '', (string) $input);
        if (mb_strlen($numbers) != self::IMEI_SIZE) {
            return false;
        }

        return (new Luhn())->isValid($numbers);
    }
}
