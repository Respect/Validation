<?php

namespace Respect\Validation\Rules;

abstract class AbstractRule
{

    protected $messageTemplates = array();

    public function setMessageTemplate($code, $template)
    {
        $this->messageTemplates[$code] = $template;
    }

    public function getMessageTemplate($code)
    {
        return $this->messageTemplates[$code];
    }

    public function setMessageTemplates(array $templates)
    {
        foreach ($templates as $code => $message)
            $this->setMessageTemplate($code, $message);
    }

    public function getMessageTemplates()
    {
        return $this->messageTemplates;
    }

    protected function getStringRepresentation($mixed)
    {
        if (is_object($mixed))
            return get_class($mixed);
        else
            return strval($mixed);
    }

}