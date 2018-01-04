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

class Instance extends AbstractRule
{
    public $instanceName;

    public function __construct($instanceName)
    {
        $this->instanceName = $instanceName;
    }

    public function reportError($input, array $extraParams = [])
    {
        return parent::reportError($input, $extraParams);
    }

    public function validate($input)
    {
        return $input instanceof $this->instanceName;
    }
}
