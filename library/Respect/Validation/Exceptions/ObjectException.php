<?php

namespace Respect\Validation\Exceptions;

class ObjectException extends InvalidException
{
    const MSG_NOT_OBJECT = 'Object_1';
    protected $messageTemplates = array(
        self::MSG_NOT_OBJECT => '%s is not an object'
    );

    public function __construct($input)
    {
        parent::__construct(
                sprintf(
                    $this->getMessageTemplate(self::MSG_NOT_OBJECT),
                    $this->getStringRepresentation($input)
                )
        );
    }

}