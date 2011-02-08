<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;

class Between extends AllOf
{

    protected $min;
    protected $max;

    public function __construct($min=null, $max=null, $inclusive=false)
    {
        $this->min = $min;
        $this->max = $max;
        if (!is_null($min) && !is_null($max) && $min > $max)
            throw new ComponentException(
                sprintf(
                    '%s cannot be less than  %s for validation', $min, $max
                )
            );
        if (!is_null($min))
            $this->addRule(new Min($min, $inclusive));
        if (!is_null($max))
            $this->addRule(new Max($max, $inclusive));
    }

    public function reportError($input, array $relatedExceptions=array())
    {
        return parent::reportError($input, array(), $this->min, $this->max);
    }

}