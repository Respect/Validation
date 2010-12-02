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

    public function createException()
    {
        return new ValidationException;
    }

    public function getException()
    {
        if (is_null($this->exception))
            $this->exception = $this->createException();
        return $this->exception;
    }

}