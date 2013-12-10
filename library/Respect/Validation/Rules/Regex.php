<?php
namespace Respect\Validation\Rules;

class Regex extends AbstractRule
{
    public $regex;

    public function __construct($regex)
    {
        $this->regex = $regex;
    }

    public function validate($input)
    {
        return (bool) preg_match($this->regex, $input);
    }
}

