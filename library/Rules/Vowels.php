<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

class Vowels extends Vowel
{
    public function __construct()
    {
        parent::__construct();
        trigger_error('Use vowel instead.', E_USER_DEPRECATED);
    }
}
