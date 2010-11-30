<?php

namespace Respect\Validation\Exceptions;

class HasKeyException extends InvalidException
{
    const MSG_KEY_NOT_PRESENT = 'HasKey_1';
    protected $messageTemplates = array(
        self::MSG_KEY_NOT_PRESENT => 'Array %s does not have the key %s'
    );

    public function __construct($input, $keyName)
    {
        parent::__construct(
                sprintf(
                    $this->getMessageTemplate(self::MSG_KEY_NOT_PRESENT),
                    $this->getStringRepresentation($input), $keyName
                )
        );
    }

}