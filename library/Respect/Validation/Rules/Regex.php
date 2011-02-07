<?php

namespace Respect\Validation\Rules;

class Regex extends AbstractRule
{

    protected $regex;

    public function __construct($regex)
    {
        $this->regex = $regex;
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this->reportError($input, array(), $this->regex);
        return true;
    }

    public function validate($input)
    {
        return preg_match("/{$this->regex}/", $input);
    }

}