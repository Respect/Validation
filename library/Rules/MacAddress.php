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

class MacAddress extends AbstractRule
{
    public function validate($input)
    {
        return !empty($input) && preg_match('/^(([0-9a-fA-F]{2}-){5}|([0-9a-fA-F]{2}:){5})[0-9a-fA-F]{2}$/', $input);
    }
}
