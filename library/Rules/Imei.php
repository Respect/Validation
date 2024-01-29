<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

use function is_scalar;
use function mb_strlen;
use function preg_replace;

#[Template(
    '{{name}} must be a valid IMEI',
    '{{name}} must not be a valid IMEI',
)]
final class Imei extends AbstractRule
{
    private const IMEI_SIZE = 15;

    /**
     * @see https://en.wikipedia.org/wiki/International_Mobile_Station_Equipment_Identity
     */
    public function validate(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $numbers = (string) preg_replace('/\D/', '', (string) $input);
        if (mb_strlen($numbers) != self::IMEI_SIZE) {
            return false;
        }

        return (new Luhn())->validate($numbers);
    }
}
