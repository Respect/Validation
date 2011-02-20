<?php

namespace Respect\Validation;

use ReflectionClass;
use ReflectionException;
use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Rules\AllOf;

class Validator extends AllOf
{

    protected $arguments = array();
    protected $ruleName;

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
        if ($ruleSpec instanceof Validatable)
            return $ruleSpec;
        else
            try {
                $validatorFqn = static::getRuleClassname($ruleSpec);
                $validatorClass = new ReflectionClass($validatorFqn);
                $validatorInstance = $validatorClass->newInstanceArgs(
                        $arguments
                );
                return $validatorInstance;
            } catch (ReflectionException $e) {
                throw new ComponentException($e->getMessage());
            }
    }

    public function __call($method, $arguments)
    {
        array_unshift($arguments, $method);
        $this->applyParts($arguments);
        return $this;
    }

    public function reportError($input, array $extraParams=array())
    {
        $exception = new AllOfException;
        $input = AllOfException::stringify($input);
        $name = $this->getName() ? : "\"$input\"";
        $params = array_merge($extraParams, get_object_vars($this));
        $exception->configure($name, $params);
        return $exception;
    }

    protected static function getRuleClassname($ruleName)
    {
        $ruleFqn = explode('\\', get_called_class());
        array_pop($ruleFqn);
        $ruleFqn[] = 'Rules';
        $ruleFqn[] = $ruleName;
        $ruleFqn = array_map('ucfirst', $ruleFqn);
        $ruleFqn = implode('\\', $ruleFqn);
        return $ruleFqn;
    }

    protected function addArgument($argument)
    {
        $this->arguments[] = $argument;
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

    protected function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
    }

    protected function setRuleName($ruleName)
    {
        $this->ruleName = $ruleName;
    }

}
