<?php

namespace Respect\Validation;

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

}