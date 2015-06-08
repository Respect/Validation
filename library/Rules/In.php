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

class In extends AbstractSearcher
{
    public $haystack;
    public $compareIdentical;

    public function __construct($haystack, $compareIdentical = false)
    {
        $this->haystack = $haystack;
        $this->compareIdentical = $compareIdentical;
    }
}
