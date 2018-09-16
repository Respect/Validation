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

use function preg_match;

class Vowel extends AbstractFilterRule
{
    protected function validateClean($input)
    {
        return preg_match('/^(\s|[aeiouAEIOU])*$/', $input) > 0;
    }
}
