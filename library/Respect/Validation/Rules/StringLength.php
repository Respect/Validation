<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ComponentException;

class StringLength extends Between
{

    public function __construct($min=null, $max=null)
    {
        $paramValidator = new OneOf(new Numeric, new NullValue);
        if (!$paramValidator->validate($min))
            throw new ComponentException(
                sprintf('%s is not a valid numeric length', $min)
            );

        if (!$paramValidator->validate($max))
            throw new ComponentException(
                sprintf('%s is not a valid numeric length', $max)
            );
        parent::__construct($min, $max);
    }

    protected function appendRule(Validatable $validator)
    {
        parent::appendRule(new Call('strlen', $validator));
    }

}