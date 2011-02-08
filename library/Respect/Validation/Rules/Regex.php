<?php

namespace Respect\Validation\Rules;

class Regex extends AbstractRule
{

    protected $regex;

    public function __construct($regex)
    {
        $this->regex = $regex;
    }

    public function reportError($input, array $related=array())
    {
        return parent::reportError($input, $related, $this->regex);
    }
    public function validate($input)
    {
        return preg_match("/{$this->regex}/", $input);
    }

}