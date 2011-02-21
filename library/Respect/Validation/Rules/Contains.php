<?php

namespace Respect\Validation\Rules;

class Contains extends AbstractRule
{

    public $containsValue;
    public $identical;

    public function __construct($containsValue, $identical=false)
    {
        $this->containsValue = $containsValue;
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
            return in_array($this->containsValue, $input);
        else
            return false !== mb_stripos($input, $this->containsValue);
    }

    protected function validateIdentical($input)
    {
        if (is_array($input))
            return in_array($this->containsValue, $input, true);
        else
            return false !== mb_strpos($input, $this->containsValue);
    }

}
