<?php

namespace Respect\Validation\Exceptions;

class CallException extends AbstractRelatedException
{

    public function getMainMessage()
    {
        if (1 === count($this->related))
            return $this->related[0]->getMainMessage();
        else
            return parent::getMainMessage();
    }

}