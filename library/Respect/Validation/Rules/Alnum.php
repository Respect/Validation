<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotAlphanumericException;
use Respect\Validation\Exceptions\ComponentException;

class Alnum extends AbstractRule
{

    protected $additionalChars = '';

    public function __construct($additionalChars='')
    {
        if (!is_string($additionalChars))
            throw new ComponentException(
                'Invalid list of additional characters to be loaded'
            );
        $this->additionalChars = $additionalChars;
    }

    public function validate($input)
    {
        return is_string($input) && preg_match(
            "#^[a-zA-Z0-9]+$#",
            str_replace(str_split($this->additionalChars), '', $input)
        );
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new NotAlphanumericException($input, $this->additionalChars);
        return true;
    }

}