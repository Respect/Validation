<?php

namespace Respect\Validation\Exceptions;

use Exception;
use InvalidArgumentException;

class InvalidException extends InvalidArgumentException
{

    protected $exceptions = array();

    public function __construct($spec)
    {
        if (is_string($spec)) {
            $message = $spec;
        } elseif (is_array($spec)) {
            $messages = array();
            foreach ($spec as $m) {
                if ($m instanceof Exception) {
                    $messages[] = $m->getMessage();
                    $this->addException($m);
                }
            }
            $message = implode(PHP_EOL, $messages);
        }
        parent::__construct($message);
    }

    protected function addException($e)
    {
        $this->exceptions[] = $e;
    }

    public function getExceptions()
    {
        return $this->exceptions;
    }

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