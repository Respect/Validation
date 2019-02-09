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

/**
 * @author Davide Pastore <pasdavide@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class HexRgbColor extends Xdigit
{
    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if (mb_strpos($input, '#') === 0) {
            $input = mb_substr($input, 1);
        }

        $length = mb_strlen($input);
        if ($length != 3 && $length != 6) {
            return false;
        }

        return parent::validate($input);
    }
}
