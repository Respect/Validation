<?php

namespace Respect\Validation\Rules;

abstract class AbstractRule
{

    protected $messages = array();

    public function setMessage($code, $message)
    {
        $this->messages[$code] = $message;
    }

    public function getMessage($code)
    {
        return $this->messages[$code];
    }

    public function setMessages(array $messages)
    {
        foreach ($messages as $code => $message)
            $this->setMessage($code, $message);
    }

    public function getMessages()
    {
        return $this->messages;
    }

    protected function getStringRepresentation($mixed)
    {
        if (is_object($mixed))
            return get_class($mixed);
        else
            return strval($mixed);
    }

}