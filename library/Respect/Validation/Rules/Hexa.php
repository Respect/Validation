<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotHexadecimalException;

class Hexa extends AbstractRule
{
    const MSG_NOT_HEXADECIMAL = 'Hexa_1';
    protected $messageTemplates = array(
        self::MSG_NOT_HEXADECIMAL => '%s is not a valid hexadecimal number'
    );

    public function validate($input)
    {
        return ctype_xdigit($input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new NotHexadecimalException(
                sprintf($this->getMessageTemplate(self::MSG_NOT_HEXADECIMAL),
                    $input)
            );
        return true;
    }

}