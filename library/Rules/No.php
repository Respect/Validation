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

class No extends Regex
{
    public function __construct($useLocale = false)
    {
        $pattern = '^n(o(t|pe)?|ix|ay)?$';
        if ($useLocale && defined('NOEXPR')) {
            $pattern = nl_langinfo(NOEXPR);
        }

        parent::__construct('/'.$pattern.'/i');
    }
}
