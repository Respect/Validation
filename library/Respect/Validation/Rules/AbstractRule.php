<?php

namespace Respect\Validation\Rules;

use Exception;
use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ValidationException;

abstract class AbstractRule implements Validatable
{

    protected $exception;
    protected $name;

    public function __construct()
    {
        //a constructor is required for ReflectionClass::newInstance()
    }

    public function __invoke($input)
    {
        return $this->validate($input);
    }

    public function assert($input)
    {
        if ($this->validate($input))
            return true;
        else
            throw $this->reportError($input);
    }

    public function check($input)
    {
        return $this->assert($input);
    }

    public function getName()
    {
        return $this->name;
    }

    public function reportError($input, array $extraParams=array())
    {
        $exception = $this->createException();
        $input = ValidationException::stringify($input);
        $name = $this->getName() ? : "\"$input\"";
        $params = array_merge($extraParams, get_object_vars($this));
        $exception->configure($name, $params);
        return $exception;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    protected function createException()
    {
        $currentFQN = get_called_class();
        $exceptionFQN = str_replace('\\Rules\\', '\\Exceptions\\', $currentFQN);
        $exceptionFQN .= 'Exception';
        return new $exceptionFQN;
    }

}
