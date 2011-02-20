<?php

namespace Respect\Validation\Rules;

class EndsWith extends AbstractRule
{

    public $endValue;
    public $identical;

    public function __construct($endValue, $identical=false)
    {
        $this->endValue = $endValue;
        $this->identical = $identical;
    }

    public function validate($input)
    {
        if ($this->identical)
            return $this->validateIdentical($input);
        else
            return $this->validateEquals($input);
    }

    protected function validateEquals($input)
    {
        if (is_array($input))
            return end($input) == $this->endValue;
        else
            return mb_strripos($input, $this->endValue, -1)
            === mb_strlen($input) - mb_strlen($this->endValue) ;
    }

    protected function validateIdentical($input)
    {
        if (is_array($input))
            return end($input) === $this->endValue;
        else
            return mb_strrpos($input, $this->endValue)
            === mb_strlen($input) - mb_strlen($this->endValue);
    }

}
