<?php

namespace Respect\Validation\Rules;

class Max extends AbstractRule
{

    protected $max;
    protected $inclusive;

    public function __construct($maxValue, $inclusive=false)
    {
        $this->max = $maxValue;
        $this->inclusive = $inclusive;
    }

    public function validate($input)
    {
        if ($this->inclusive)
            return $input <= $this->max;
        else
            return $input < $this->max;
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this->getException() ? : $this->createException()
                    ->configure($input, $this->max, $this->inclusive);
        return true;
    }

}