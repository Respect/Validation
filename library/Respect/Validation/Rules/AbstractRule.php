<?php

namespace Respect\Validation\Rules;

use Exception;
use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

abstract class AbstractRule implements Validatable
{

    protected $exception;
    protected $id;

    public function __construct()
    {
        
    }

    public function __invoke($input)
    {
        return $this->validate($input);
    }

    public function createException()
    {
        $currentFQN = get_called_class();
        $exceptionFQN = str_replace('\\Rules\\', '\\Exceptions\\', $currentFQN);
        $exceptionFQN .= 'Exception';
        return new $exceptionFQN;
    }

    public function getException()
    {
        return $this->exception;
    }

    public function setException(ValidationException $e)
    {
        $this->exception = $e;
        return $this;
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this->getException() ? : $this->createException()
                    ->configure($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}