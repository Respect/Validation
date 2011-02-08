<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

class Alpha extends AbstractRule
{

    protected $additionalChars = '';
    protected $stringFormat = '#^([a-zA-Z]|\s)+$#';

    public function __construct($additionalChars='')
    {
        if (!is_string($additionalChars))
            throw new ComponentException(
                'Invalid list of additional characters to be loaded'
            );
        $this->additionalChars = $additionalChars;
    }

    public function reportError($input, array $related=array())
    {
        return parent::reportError($input, $related, $this->additionalChars);
    }

    public function validate($input)
    {
        return is_string($input) && preg_match(
            $this->stringFormat,
            str_replace(str_split($this->additionalChars), '', $input)
        );
    }

}