<?php

namespace Respect\Validation;

use ReflectionClass;

class Validator
{

    protected $subject;
    protected $rule;
    protected $arguments = array();
    protected $validators = array();

    public function getSubject()
    {
        return $this->subject;
    }

    public function getRule()
    {
        return $this->rule;
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function setRule($rule)
    {
        $this->rule = $rule;
    }

    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
    }

    public function addArgument($argument)
    {
        $this->arguments[] = $argument;
    }

    public function addValidator(Validatable $validator)
    {
        $this->validators[spl_object_hash($validator)] = $validator;
    }

    public function getValidators()
    {
        return $this->validators;
    }

    public function __call($method, $arguments)
    {
        array_unshift($arguments, $method);
        foreach ($arguments as $a) {
            if (!isset($this->subject)) {
                $this->setSubject($a);
                continue;
            }
            if (!isset($this->rule)) {
                $this->setRule($a);
                continue;
            }
            $this->addArgument($a);
        }
        $this->checkForCompleteRule();
        return $this;
    }

    public function validates($input)
    {
        $v = new Composite\All();
        $v->addRules($this->validators);
        return $v->validate($input);
    }

    public function checkForCompleteRule()
    {
        if (!isset($this->subject, $this->rule))
            return;
        $this->addValidator(
            static::buildRule(
                array($this->subject, $this->rule), $this->arguments
            )
        );
        $this->subject = null;
        $this->rule = null;
        $this->arguments = array();
    }

    public static function __callStatic($subject, $arguments)
    {
        $rule = array_shift($arguments);
        $validator = new static;
        $validator->setSubject($subject);
        $validator->setRule($rule);
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
        if (!is_array($ruleSpec))
            $ruleSpec = explode('\\', $ruleSpec);
        $validatorFqn = array_merge($validatorFqn, $ruleSpec);
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