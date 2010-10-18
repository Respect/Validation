<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotDigitsException;

class Digits extends AbstractRule
{
    const MSG_NOT_DIGITS = 'Digits_1';
    protected $messageTemplates = array(
        self::MSG_NOT_DIGITS => '%s does not contain only digits'
    );

    public function validate($input)
    {
        return ctype_digit((string) $input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw new NotDigitsException(
                sprintf($this->getMessageTemplate(self::MSG_NOT_DIGITS), $input)
            );
        return true;
    }

}