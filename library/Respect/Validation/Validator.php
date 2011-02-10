<?php

namespace Respect\Validation;

use ReflectionClass;
use ReflectionException;
use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Rules\AllOf;

class Validator extends AllOf
{
    const ERR_INTERFACE = '%s does not implement the Respect\Validator\Validatable interface required for validators';

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
        if ($ruleSpec instanceof Validatable) {
            return $ruleSpec;
        }
        if (is_object($ruleSpec))
            throw new ComponentException(
                sprintf(static::ERR_INTERFACE, get_class($ruleSpec))
            );
        $validatorFqn = static::getRuleClassname($ruleSpec);
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
                sprintf(static::ERR_INTERFACE, $validatorFqn)
            );
        $validatorInstance = $validatorClass->newInstanceArgs(
                $arguments
        );
        return $validatorInstance;
    }

    public function __call($method, $arguments)
    {
        array_unshift($arguments, $method);
        $this->applyParts($arguments);
        return $this;
    }

    public function createException()
    {
        return new AllOfException;
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
