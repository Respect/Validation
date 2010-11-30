<?php

namespace Respect\Validation\Exceptions;

class InstanceException extends InvalidException
{
    const MSG_NOT_INSTANCE = 'Instance_1';
    protected $messageTemplates = array(
        self::MSG_NOT_INSTANCE => '%s is not an instance  %s'
    );

    public function __construct($input, $instance)
    {
        parent::__construct(
                sprintf(
                    $this->getMessageTemplate(self::MSG_NOT_INSTANCE),
                    $this->getStringRepresentation($input),
                    $this->getStringRepresentation($instance)
                )
        );
    }

}