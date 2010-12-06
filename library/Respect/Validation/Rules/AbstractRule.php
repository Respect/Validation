<?php

namespace Respect\Validation\Rules;

use Exception;
use Respect\Validation\Validatable;

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

    public function setException(Exception $e)
    {
        $this->exception = $e;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}