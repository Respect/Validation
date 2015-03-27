<?php
namespace Respect\Validation\Exceptions;

class EqualsException extends ValidationException
{
    const EQUALS = 0;
    const IDENTICAL = 1;


    public function chooseTemplate()
    {
        return $this->getParam('identical') ? static::IDENTICAL : static::EQUALS;
    }
}
