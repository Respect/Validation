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

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validatable;

class NestedKey extends AbstractRelated
{
    public function __construct($reference, Validatable $referenceValidator = null, $mandatory = true)
    {
        if (!$reference) {
            throw new ComponentException('Invalid array key');
        }
        parent::__construct($reference, $referenceValidator, $mandatory);
    }

    public function hasReference($input)
    {
        // TODO: Implement hasReference() method.
    }

    public function getReferenceValue($input)
    {
        // TODO: Implement getReferenceValue() method.
    }
}