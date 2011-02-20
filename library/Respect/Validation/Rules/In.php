<?php

namespace Respect\Validation\Rules;

class In extends AbstractRule
{

    public $haystack;
    public $compareIdentical;

    public function __construct($haystack, $compareIdentical=false)
    {
        $this->haystack = $haystack;
        $this->compareIdentical = $compareIdentical;
    }

    public function reportError($input, array $extraParams=array())
    {
        return parent::reportError($input, $extraParams);
    }

    public function validate($input)
    {
        if (is_array($this->haystack))
            return in_array($input, $this->haystack, $this->compareIdentical);
        elseif (!is_string($this->haystack))
            return false;
        elseif ($this->compareIdentical)
            return mb_strpos($this->haystack, $input) !== false;
        else
            return mb_stripos($this->haystack, $input) !== false;
    }

}
