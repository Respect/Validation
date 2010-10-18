<?php

namespace Respect\Validation\Exceptions;

class NotBetweenException extends InvalidException
{

    protected $min;
    protected $max;
    protected $type;
    const MSG_LESS = 'Between_1';
    const MSG_MORE = 'Between_2';
    protected $messageTemplates = array(
        self::MSG_LESS => '%s is less than the specified minimum of %s',
        self::MSG_MORE => '%s is more than the specified maximum of %s',
    );

    public function __construct($input, $isMinValid, $isMaxValid, $min, $max)
    {
        $messages = array();
        if (!$isMinValid)
            $messages[] = sprintf(
                $this->getMessageTemplate(self::MSG_LESS),
                $this->getStringRepresentation($input),
                $this->getStringRepresentation($min)
            );
        if (!$isMaxValid)
            $messages[] = sprintf(
                $this->getMessageTemplate(self::MSG_MORE),
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