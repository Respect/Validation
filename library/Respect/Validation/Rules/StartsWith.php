<?php

namespace Respect\Validation\Rules;

class StartsWith extends AbstractRule
{

    public $startValue;
    public $identical;

    public function __construct($startValue, $identical=false)
    {
        $this->startValue = $startValue;
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
            return reset($input) == $this->startValue;
        else
            return 0 === mb_stripos($input, $this->startValue);
    }

    protected function validateIdentical($input)
    {
        if (is_array($input))
            return reset($input) === $this->startValue;
        else
            return 0 === mb_strpos($input, $this->startValue);
    }

}
