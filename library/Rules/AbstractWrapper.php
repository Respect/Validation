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

use Respect\Validation\Validatable;
use Respect\Validation\RequiredValidatable;
use Respect\Validation\Exceptions\ComponentException;

abstract class AbstractWrapper extends AbstractRule implements RequiredValidatable
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

    protected function validateConcrete($input)
    {
        return $this->getValidatable()->validate($input);
    }
}
