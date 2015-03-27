<?php
namespace Respect\Validation\Exceptions;

class AlphaException extends ValidationException
{
    const EXTRA = 1;


    public function chooseTemplate()
    {
        return $this->getParam('additionalChars') ? static::EXTRA : static::STANDARD;
    }
}
