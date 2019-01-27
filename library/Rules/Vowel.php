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

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
class Vowel extends AbstractFilterRule
{
    protected function validateFilteredInput(string $input): bool
    {
        return preg_match('/^(\s|[aeiouAEIOU])*$/', $input) > 0;
    }
}
