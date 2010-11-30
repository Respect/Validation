<?php

namespace Respect\Validation\Exceptions;

class TraversableException extends InvalidException
{
    const MSG_NOT_TRAVERSABLE = 'Traversable_1';
    protected $messageTemplates = array(
        self::MSG_NOT_TRAVERSABLE => '%s is not traversable'
    );

    public function __construct($input)
    {
        parent::__construct(
                sprintf(
                    $this->getMessageTemplate(self::MSG_NOT_TRAVERSABLE),
                    $this->getStringRepresentation($input)
                )
        );
    }

}