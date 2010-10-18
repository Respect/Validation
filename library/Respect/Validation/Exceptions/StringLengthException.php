<?php

namespace Respect\Validation\Exceptions;

class StringLengthException extends InvalidException
{
    const MSG_LENGTH_MIN = 'StringLength_1';
    const MSG_LENGTH_MAX = 'StringLength_2';

    protected $messageTemplates = array(
        self::MSG_LENGTH_MIN => '%s does not have at least %s characters',
        self::MSG_LENGTH_MAX => '%s exceeds the maximum of %s characters'
    );

    public function __construct($input, $isMinValid, $isMaxValid, $min, $max)
    {
        $messages = array();
        if (!$isMinValid)
            $messages[] = sprintf(
                $this->getMessageTemplate(self::MSG_LENGTH_MIN),
                $this->getStringRepresentation($input),
                $this->getStringRepresentation($min)
            );
        if (!$isMaxValid)
            $messages[] = sprintf(
                $this->getMessageTemplate(self::MSG_LENGTH_MAX),
                $this->getStringRepresentation($input),
                $this->getStringRepresentation($max)
            );
        if (count($messages) > 1) {
            $exceptions = array();
            foreach ($messages as $m)
                $exceptions = new static($m);
            parent::__construct($exceptions);
        } else {
            parent::__construct($messages[0]);
        }
    }

}