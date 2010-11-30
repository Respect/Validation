<?php

namespace Respect\Validation\Exceptions;

class NullValueException extends InvalidException
{
    const MSG_NOT_NULL = 'NullValue_1';
    protected $messageTemplates = array(
        self::MSG_NOT_NULL => '%s is not null'
    );

    public function __construct($input)
    {
        parent::__construct(
                sprintf($this->getMessageTemplate(self::MSG_NOT_NULL), $input)
        );
    }

}