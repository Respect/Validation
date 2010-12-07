<?php

namespace Respect\Validation\Exceptions;

class CallException extends ValidationException
{

    public function renderMessage()
    {
        $this->message = $this->related[0]->getMessage();
    }

}