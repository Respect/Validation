<?php

namespace Respect\Validation\Exceptions;

class NotArrayException extends InvalidException
{
    const MSG_NOT_ARRAY = 'Array_1';
    protected $messageTemplates = array(
        self::MSG_NOT_ARRAY => '%s is not an array'
    );

    public function __construct($input)
    {
        parent::__construct(
                sprintf(
                    $this->getMessageTemplate(self::MSG_NOT_ARRAY),
                    $this->getStringRepresentation($input)
                )
        );
    }

}