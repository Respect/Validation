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

use function is_string;
use function mb_strlen;
use function preg_match;

/**
 * Validate if a string is Base64-encoded.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jens Segers <segers.jens@gmail.com>
 * @author William Espindola <oi@william.espindola.com.br>
 */
final class Base64 extends AbstractRule
{
    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if (!preg_match('#^[A-Za-z0-9+/\n\r]+={0,2}$#', $input)) {
            return false;
        }

        return 0 === mb_strlen($input) % 4;
    }
}
