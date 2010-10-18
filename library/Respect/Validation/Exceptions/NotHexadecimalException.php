<?php

namespace Respect\Validation\Exceptions;

class NotHexadecimalException extends InvalidException
{
    const MSG_NOT_HEXADECIMAL = 'Hexa_1';
    protected $messageTemplates = array(
        self::MSG_NOT_HEXADECIMAL => '%s is not a valid hexadecimal number'
    );

    public function __construct($input)
    {
        parent::__construct(
                sprintf(
                    $this->getMessageTemplate(self::MSG_NOT_HEXADECIMAL), $input
                )
        );
    }

}