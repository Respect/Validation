<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

abstract class AbstractRule implements Validatable
{

    protected $exception;

    public function __invoke($input)
    {
        return $this->validate($input);
    }

    public function getException()
    {
        return $this->exception;
    }

    public function setException()
    {
        
    }

}