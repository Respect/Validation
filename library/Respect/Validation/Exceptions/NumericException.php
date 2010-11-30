<?php

namespace Respect\Validation\Exceptions;

class NumericException extends InvalidException
{
    
    const MSG_NOT_NUMERIC = 'Numeric_1';
    protected $messageTemplates = array(
        self::MSG_NOT_NUMERIC => '%s is not a numeric value'
    );

    public function __construct($input)
    {
        parent::__construct(
                sprintf($this->getMessageTemplate(self::MSG_NOT_NUMERIC),
                    $input)
        );
    }
}