<?php

namespace Respect\Validation\Exceptions;

class NumberOutOfBoundsException extends InvalidException
{

    protected $min;
    protected $max;
    const MSG_NUMBER_LESS = 'NumberBetween_1';
    const MSG_NUMBER_MORE = 'NumberBetween_2';
    protected $messageTemplates = array(
        self::MSG_NUMBER_LESS => '%s is less than the specified minimum (%s)',
        self::MSG_NUMBER_MORE => '%s is more than the specified maximum (%s)',
    );

    public function __construct($input, $isMinValid, $isMaxValid, $min, $max)
    {
        $messages = array();
        if (!$isMinValid)
            $messages[] = sprintf(
                $this->getMessageTemplate(self::MSG_NUMBER_LESS),
                $this->getStringRepresentation($input),
                $this->getStringRepresentation($min)
            );
        if (!$isMaxValid)
            $messages[] = sprintf(
                $this->getMessageTemplate(self::MSG_NUMBER_MORE),
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