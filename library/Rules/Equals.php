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

class Equals extends AbstractRule
{
    public $compareIdentical = false;
    public $compareTo = null;

    public function __construct($compareTo, $compareIdentical = false)
    {
        $this->compareTo = $compareTo;
        $this->compareIdentical = $compareIdentical;
    }

    public function reportError($input, array $extraParams = array())
    {
        return parent::reportError($input, $extraParams);
    }

    public function validate($input)
    {
        if ($this->compareIdentical) {
            return $input === $this->compareTo;
        }

        return $input == $this->compareTo;
    }
}
