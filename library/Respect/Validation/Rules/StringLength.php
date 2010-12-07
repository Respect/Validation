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
        if (!is_null($min) && !is_null($max) && $min > $max)
            throw new ComponentException(
                sprintf(
                    '%s cannot be less than  %s for validation', $min, $max
                )
            );
        if (!is_null($min))
            $this->addRule(new Call('strlen', new Min($min)));
        if (!is_null($max))
            $this->addRule(new Call('strlen', new Max($max)));
    }

}