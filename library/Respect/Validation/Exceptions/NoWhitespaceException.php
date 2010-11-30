<?php

namespace Respect\Validation\Exceptions;

class NoWhitespaceException extends InvalidException
{
    const MSG_WHITESPACE_FOUND = 'NoWhitespace_1';
    protected $messageTemplates = array(
        self::MSG_WHITESPACE_FOUND => '%s contains spaces, tabs, line breaks or other not allowed charaters.'
    );

    public function __construct($input)
    {
        parent::__construct(
                sprintf($this->getMessageTemplate(self::MSG_WHITESPACE_FOUND),
                    $input)
        );
    }

}