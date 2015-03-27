<?php
namespace Respect\Validation\Exceptions;

class MaxException extends ValidationException
{
    const INCLUSIVE = 1;


    public function chooseTemplate()
    {
        return $this->getParam('inclusive') ? static::INCLUSIVE : static::STANDARD;
    }
}
