<?php

namespace Respect\Validation;

use Respect\Validation\Rules\AllOf;
use ReflectionClass;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\AllOfException;
use ReflectionException;

class Validator extends AllOf
{

    protected $ruleName;
    protected $arguments = array();

    protected function getRuleName()
    {
        return $this->ruleName;
    }

    protected function getArguments()
    {
        return $this->arguments;
    }

    protected function setRuleName($ruleName)
    {
        $this->ruleName = $ruleName;
    }

    protected function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
    }

    protected function addArgument($argument)
    {
        $this->arguments[] = $argument;
    }

    public function __get($property)
    {
        $this->applyParts(func_get_args());
        return $this;
    }

    protected function applyParts($parts)
    {
        foreach ($parts as $a) {
            if (!isset($this->ruleName))
                $this->setRuleName($a);
            else
                $this->addArgument($a);
        }
        $this->checkForCompleteRule();
    }

    public function __call($method, $arguments)
    {
        array_unshift($arguments, $method);
        $this->applyParts($arguments);
        return $this;
    }

    protected function checkForCompleteRule()
    {
        if (!isset($this->ruleName))
            return;
        $this->addRule(
            static::buildRule($this->ruleName, $this->arguments)
        );
        $this->ruleName = null;
        $this->arguments = array();
    }

    public static function __callStatic($ruleName, $arguments)
    {
        $validator = new static;
        $validator->setRuleName($ruleName);
        $validator->setArguments($arguments);
        $validator->checkForCompleteRule();
        return $validator;
    }

    public static function buildRule($ruleSpec, $arguments=array())
    {
        if ($ruleSpec instanceof Validatable) {
            return $ruleSpec;
        }
        if (is_object($ruleSpec))
            throw new ComponentException(
                sprintf('%s does not implement the Respect\Validator\Validatable interface required for validators',
                    get_class($ruleSpec))
            );
        $validatorFqn = explode('\\', get_called_class());
        array_pop($validatorFqn);
        $validatorFqn[] = 'Rules';
        $validatorFqn[] = $ruleSpec;
        $validatorFqn = array_map('ucfirst', $validatorFqn);
        $validatorFqn = implode('\\', $validatorFqn);
        try {
            $validatorClass = new ReflectionClass($validatorFqn);
        } catch (ReflectionException $e) {
            throw new ComponentException($e->getMessage());
        }
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

    protected function createException()
    {
        return new AllOfException;
    }

}