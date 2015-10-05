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

class Instance extends AbstractRule
{
    public $instanceName;

    public function __construct($instanceName)
    {
        $this->instanceName = $instanceName;
    }

    public function reportError($input, array $extraParams = array())
    {
        return parent::reportError($input, $extraParams);
    }

    public function validate($input)
    {
        if ($this->isOptional($input)) {
            return true;
        }

        return $input instanceof $this->instanceName;
    }
}
