<?php

namespace Respect\Validation\Exceptions;

class EmptyStringException extends InvalidException
{
    const MSG_EMPTY_STRING = 'StringNotEmpty_1';

    protected $messageTemplates = array(
        self::MSG_EMPTY_STRING => 'You provided an empty string'
    );

    public function __construct()
    {
        parent::__construct($this->getMessageTemplate(self::MSG_EMPTY_STRING));
    }

}