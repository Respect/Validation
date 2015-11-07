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

class Image extends AbstractRule
{
    public function validate($input)
    {
    	if (is_file($input) || filter_var($input, FILTER_VALIDATE_URL)) {
     	   return is_array(getimagesize($input));
    	}

    	return false;
    }
}
