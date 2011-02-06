<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ComponentException;

class Key extends AbstractRelated
{

    public function __construct($reference,
        Validatable $referenceValidator=null, $mandatory=true)
    {
        if (!is_string($reference) || empty($reference))
            throw new ComponentException(
                'Invalid array key name'
            );
        parent::__construct($reference, $referenceValidator, $mandatory);
        $this->setName($reference);
    }

    protected function hasReference($input)
    {
        return array_key_exists($this->reference, $input);
    }

    protected function getReferenceValue($input)
    {
        return @$input[$this->reference];
    }

}