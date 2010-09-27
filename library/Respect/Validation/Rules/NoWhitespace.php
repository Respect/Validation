<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\WhitespaceFoundException;

class NoWhitespace extends AbstractRule implements Validatable
{
    const MSG_WHITESPACE_FOUND = 'NoWhitespace_1';
    protected $messages = array(
        self::MSG_WHITESPACE_FOUND => '%s contains spaces, tabs, line breaks or other not allowed charaters.'
    );

    public function validate($input)
    {
        return preg_match('#^\S+$#', $input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new WhitespaceFoundException(
                sprintf($this->getMessage(self::MSG_WHITESPACE_FOUND), $input)
            );
        return true;
    }

}