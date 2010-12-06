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

    public function setException(Exception $e)
    {
        $this->exception = $e;
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