<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\HasAttribute;

class HasOptionalAttribute extends HasAttribute
{

    public function validate($input)
    {
        return @!property_exists($input, $this->attribute)
        || parent::validate($input->{$this->attribute});
    }

}