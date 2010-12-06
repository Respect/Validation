<?php

namespace Respect\Validation\Rules;

class Regex extends AbstractRule
{

    protected $regex;

    public function __construct($regex)
    {
        $this->regex = $regex;
    }

    public function validate($input)
    {
        return preg_match("/{$this->regex}/", $input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this->getException() ? : $this->createException()
                    ->configure($input, $this->regex);
        return true;
    }

}