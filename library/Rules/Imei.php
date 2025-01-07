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

use function is_scalar;
use function mb_strlen;
use function preg_replace;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a valid IMEI number',
    '{{name}} must not be a valid IMEI number',
)]
final class Imei extends Simple
{
    private const IMEI_SIZE = 15;

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
