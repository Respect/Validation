<?php

namespace Respect\Validation\Rules;

class Min extends AbstractRule
{

    protected $min;
    protected $inclusive;

    public function __construct($minValue, $inclusive=false)
    {
        $this->min = $minValue;
        $this->inclusive = $inclusive;
    }

    public function validate($input)
    {
        if ($this->inclusive)
            return $input >= $this->min;
        else
            return $input > $this->min;
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this->reportError($input, array(), $this->min,
                $this->inclusive);
        return true;
    }

}