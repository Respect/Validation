<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ComponentException;

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
