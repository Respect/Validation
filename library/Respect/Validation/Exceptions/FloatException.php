<?php

namespace Respect\Validation\Exceptions;

class FloatException extends InvalidException
{
    const MSG_NOT_FLOAT = 'Float_1';
    protected $messageTemplates = array(
        self::MSG_NOT_FLOAT => '%s is not a valid float number'
    );

    public function __construct($input)
    {
        parent::__construct(
                sprintf($this->getMessageTemplate(self::MSG_NOT_FLOAT), $input)
        );
    }

}