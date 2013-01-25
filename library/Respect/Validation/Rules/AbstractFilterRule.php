<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

abstract class AbstractFilterRule extends AbstractRule
{
    protected $additionalChars = "";

    abstract protected function validateClean($input);

    public function __construct($additionalChars='')
    {
        if (!is_string($additionalChars))
            throw new ComponentException('Invalid list of additional characters to be loaded');

        $this->additionalChars .= $additionalChars;
    }

    protected function filter($input)
    {
        return str_replace(str_split($this->additionalChars), '', $input);
    }

    public function validate($input)
    {
        if (!is_scalar($input))
            return false;

        $cleanInput = $this->filter((string) $input);

        return $cleanInput === '' || $this->validateClean($cleanInput);
    }
}

