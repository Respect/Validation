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

class Json extends AbstractRule
{
    public function validate($input)
    {
        if (!is_string($input) || '' === $input) {
            return false;
        }

        json_decode($input);

        return JSON_ERROR_NONE === json_last_error();
    }
}
