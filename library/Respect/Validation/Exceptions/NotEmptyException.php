<?php

namespace Respect\Validation\Exceptions;

class NotEmptyException extends InvalidException
{
    const MSG_NOT_EMPTY = 'NotEmpty_1';

    protected $messageTemplates = array(
        self::MSG_NOT_EMPTY => 'You provided an empty value'
    );

    public function __construct()
    {
        parent::__construct($this->getMessageTemplate(self::MSG_NOT_EMPTY));
    }

}