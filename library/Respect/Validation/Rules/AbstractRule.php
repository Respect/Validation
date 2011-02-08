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
        //a constructor is required for ReflectionClass
    }

    public function __invoke($input)
    {
        return $this->validate($input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this->reportError($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
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

    public function getName()
    {
        return $this->name;
    }

    public function hasException()
    {
        return!empty($this->exception);
    }

    public function reportError($input, array $related=array())
    {
        if ($this->hasException())
            return $this->getException();

        $exception = $this->createException()->setRelated($related);
        $parameters = array();
        if (func_num_args() > 2)
            $parameters = array_slice(func_get_args(), 2);
        $input = ValidationException::stringify($input);
        $exceptionInput = $this->getName() ? : "\"$input\"";
        array_unshift($parameters, $exceptionInput);
        call_user_func_array(array($exception, 'configure'), $parameters);
        return $exception;
    }

    public function setException(ValidationException $e)
    {
        $this->exception = $e;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}