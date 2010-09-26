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

}