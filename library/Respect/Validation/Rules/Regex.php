<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\RegexException;

class Regex extends AbstractRule
{

    protected $regex;

    public function __construct($regex)
    {
        $this->regex = $regex;
    }

    public function createException()
    {
        return new RegexException;
    }

    public function validate($input)
    {
        return preg_match("/{$this->regex}/", $input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this
                ->getException()
                ->configure($input, $this->regex);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}