<?php
namespace Respect\Validation\Exceptions;

class NotEmptyException extends ValidationException
{
    const STANDARD = 0;
    const NAMED = 1;

    public function chooseTemplate()
    {
        return $this->getName() == "" ? static::STANDARD : static::NAMED;
    }
}
