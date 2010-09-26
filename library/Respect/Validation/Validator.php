<?php

namespace Respect\Validation;

use Respect\Validation\Rules\All;
use ReflectionClass;
use Respect\Validation\ComponentException;

class Validator extends All
{

    protected $ruleName;
    protected $arguments = array();

    public function getRuleName()
    {
        return $this->ruleName;
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    public function setRuleName($ruleName)
    {
        $this->ruleName = $ruleName;
    }

    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
    }

    public function addArgument($argument)
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
            if (!isset($this->ruleName)) {
                $this->setRuleName($a);
                continue;
            }
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