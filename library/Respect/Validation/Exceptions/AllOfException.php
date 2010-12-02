<?php

namespace Respect\Validation\Exceptions;

class AllOfException extends ValidationException
{
    const INVALID_ALLOF= 'AllOf_1';
    public static $defaultTemplates = array(
        self::INVALID_ALLOF => '%d of the %d required rules did not passed',
    );

    protected function renderMessage()
    {
        if (1 === count($this->related))
            $this->message = array_shift($this->related)->getMessage();
        else
            parent::renderMessage();
    }

}