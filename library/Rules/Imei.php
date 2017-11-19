<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

class Imei extends AbstractRule
{
    const IMEI_SIZE = 15;

    /**
     * @see https://en.wikipedia.org/wiki/International_Mobile_Station_Equipment_Identity
     *
     * @param string $input
     *
     * @return bool
     */
    public function validate($input)
    {
        if (!is_scalar($input)) {
            return false;
        }

        $numbers = preg_replace('/\D/', '', $input);
        if (self::IMEI_SIZE != mb_strlen($numbers)) {
            return false;
        }

        return (new Luhn())->validate($numbers);
    }
}
