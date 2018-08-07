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

use function is_scalar;
use function mb_strlen;
use function preg_replace;

/**
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Diego Oliveira <contato@diegoholiveira.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Alexander Gorshkov <mazanax@yandex.ru>
 */
final class Imei extends AbstractRule
{
    private const IMEI_SIZE = 15;

    /**
     * @see https://en.wikipedia.org/wiki/International_Mobile_Station_Equipment_Identity
     *
     * @param string $input
     *
     * @return bool
     */
    public function validate($input): bool
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
