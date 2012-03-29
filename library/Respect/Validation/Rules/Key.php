<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validatable;

class Key extends AbstractRelated
{

    public function __construct($reference, Validatable $referenceValidator=null, $mandatory=true)
    {
        if (!is_string($reference) || empty($reference))
            throw new ComponentException(
                'Invalid array key name'
            );
        parent::__construct($reference, $referenceValidator, $mandatory);
    }

    public function getReferenceValue($input)
    {
        return $input[$this->reference];
    }

    public function hasReference($input)
    {
        return is_array($input) && array_key_exists($this->reference, $input);
    }

}
