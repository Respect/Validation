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
            return mb_strripos($input, $this->endValue, -1, $enc = mb_detect_encoding($input))
            === mb_strlen($input, $enc) - mb_strlen($this->endValue, $enc) ;
    }

    protected function validateIdentical($input)
    {
        if (is_array($input))
            return end($input) === $this->endValue;
        else
            return mb_strrpos($input, $this->endValue, 0, $enc = mb_detect_encoding($input))
            === mb_strlen($input, $enc) - mb_strlen($this->endValue, $enc);
    }

}

