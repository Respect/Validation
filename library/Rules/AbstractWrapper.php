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

abstract class AbstractWrapper extends AbstractRule
{
    protected $validatable;

    public function getValidatable()
    {
        if (!$this->validatable instanceof Validatable) {
            throw new ComponentException('There is no defined validatable');
        }

        return $this->validatable;
    }

    public function assert($input)
    {
        return $this->getValidatable()->assert($input);
    }

    public function check($input)
    {
        return $this->getValidatable()->check($input);
    }

    public function validate($input)
    {
        return $this->getValidatable()->validate($input);
    }
}
