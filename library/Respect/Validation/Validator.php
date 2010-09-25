<?php

namespace Respect\Validation;

use ReflectionClass;

class Validator
{

    protected $input;
    protected $subject;
    protected $validator;
    protected $arguments;
    protected $operation;

    public function getOperation()
    {
        return $this->operation;
    }

    public function getInput()
    {
        return $this->input;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    public function setInput($input)
    {
        $this->input = $input;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function setValidator($validator)
    {
        $this->validator = $validator;
    }

    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
    }

    public function addArgument($argument)
    {
        $this->arguments[] = $argument;
    }

    public function setOperation($operation)
    {
        $this->operation = $operation;
    }

    public function isComplete()
    {
        return isset($this->operation, $this->input, $this->subject,
            $this->validator);
    }

    protected function applySteps(array $stepData)
    {
        foreach ($stepData as $p) {
            if (!isset($this->operation)) {
                $this->setOperation($p);
                continue;
            }
            if (!isset($this->input)) {
                $this->setInput($p);
                continue;
            }
            if (!isset($this->subject)) {
                $this->setSubject($p);
                continue;
            }
            if (!isset($this->validator)) {
                $this->setValidator($p);
                continue;
            }
            $this->addArgument($p);
        }
        if ($this->isComplete())
            return $this->execute();
        else
            return $this;
    }

    public function __call($method, $arguments)
    {
        array_unshift($arguments, $method);
        return $this->applySteps($arguments);
    }

    public function __get($property)
    {
        return $this->applySteps(array($property));
    }

    public function execute()
    {
        if (!$this->isComplete())
            throw new ComponentException('Validator not complete');
        $validatorSpec = array($this->subject, $this->validator);
        $validatorInstance = static::buildValidator($validatorSpec,
                $this->arguments);
        $operationSpec = array($validatorInstance, $this->operation);
        return call_user_func($operationSpec, $this->input);
    }

    public function __construct($operation=null, $input=null, $subject=null,
        $validator=null, $arguments=array())
    {
        $this->operation = $operation;
        $this->input = $input;
        $this->subject = $subject;
        $this->validator = $validator;
        $this->arguments = $arguments;
    }

    public static function __callStatic($method, $arguments)
    {
        preg_match('#^(is|assert)([[:alnum:]]+)?$#', $method, $matches);
        array_shift($matches);
        $input = array_shift($arguments);
        $operation = array_shift($matches);
        $subject = array_shift($matches) ? : array_shift($arguments);
        $validator = array_shift($arguments);
        $v = new static($operation, $input, $subject, $validator, $arguments);
        if ($v->isComplete())
            return $v->execute();
        else
            return $v;
    }

    public static function buildValidator($validator, $arguments=array())
    {
        if ($validator instanceof Validatable) {
            return $validator;
        }
        if (is_object($validator))
            throw new ComponentException(
                sprintf('%s does not implement the Respect\Validator\Validatable interface required for validators',
                    get_class($validator))
            );
        $validatorFqn = explode('\\', get_called_class());
        array_pop($validatorFqn);
        if (!is_array($validator))
            $validator = explode('\\', $validator);
        $validatorFqn = array_merge($validatorFqn, $validator);
        $validatorFqn = array_map('ucfirst', $validatorFqn);
        $validatorFqn = implode('\\', $validatorFqn);
        $validatorClass = new ReflectionClass($validatorFqn);
        $implementedInterface = $validatorClass->implementsInterface(
                'Respect\Validation\Validatable'
        );
        if (!$implementedInterface)
            throw new ComponentException(
                sprintf('%s does not implement the Respect\Validator\Validatable interface required for validators',
                    $validatorFqn)
            );
        if ($validatorClass->hasMethod('__construct')) {
            $validatorInstance = $validatorClass->newInstanceArgs(
                    $arguments
            );
        } else {
            $validatorInstance = new $validatorFqn;
        }
        return $validatorInstance;
    }

}