<?php

namespace Respect\Validation\Exceptions;

class DigitsException extends InvalidException
{
    const MSG_NOT_DIGITS = 'Digits_1';
    protected $messageTemplates = array(
        self::MSG_NOT_DIGITS => '%s does not contain only digits'
    );

    public function __construct($input)
    {
        parent::__construct(
                sprintf($this->getMessageTemplate(self::MSG_NOT_DIGITS), $input)
        );
    }

}