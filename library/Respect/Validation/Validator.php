<?php

namespace Respect\Validation;

use OutOfRangeException;
use LogicException;
use ReflectionClass;
use InvalidArgumentException;

class Validator implements Validatable
{

    protected $validators = array();
    protected $messages = array();

    protected function appendValidator(Validatable $validator)
    {
        $this->validators[spl_object_hash($validator)] = $validator;
        $this->messages = array_merge(
            $this->messages, $validator->getMessages()
        );
    }

    public function addValidator($validator, $arguments=array())
    {
        if ($validator instanceof Validatable) {
            $this->appendValidator($validator);
            return;
        }
        if (is_object($validator))
            throw new InvalidArgumentException(
                sprintf('%s does not implement the Respect\Validator\Validatable interface required for validators', get_class($validator))
            );
        $validatorFqn = explode('\\', get_called_class());
        array_pop($validatorFqn);
        $validatorFqn = array_merge($validatorFqn, explode('\\', $validator));
        $validatorFqn = implode('\\', $validatorFqn);
        $validatorClass = new ReflectionClass($validatorFqn);
        $implementedInterface = $validatorClass->implementsInterface(
                'Respect\Validation\Validatable'
        );
        if (!$implementedInterface)
            throw new InvalidArgumentException(
                sprintf('%s does not implement the Respect\Validator\Validatable interface required for validators', $validatorFqn)
            );
        if ($validatorClass->hasMethod('__construct')) {
            $validatorInstance = $validatorClass->newInstanceArgs(
                    $arguments
            );
        } else {
            $validatorInstance = new $validatorFqn;
        }
        $this->appendValidator($validatorInstance);
    }

    public function hasValidator($validator)
    {
        if (empty($this->validators))
            return false;
        if ($validator instanceof Valitatable)
            return isset($this->validators[spl_object_hash($validator)]);
        else
            return (boolean) array_filter(
                $this->validators, function($v) use ($validator) {
                    return (integer) ($v instanceof $validator);
                });
    }

    public function addValidators(array $validators, $prefix='')
    {
        foreach ($validators as $k => $v) {
            if (is_object($v)) {
                $this->addValidator($v);
                continue;
            } elseif (is_numeric($k)) {
                $validatorName = $v;
                $validatorArgs = array();
            } else {
                $validatorName = $k;
                if (!empty($v) && !is_array($v))
                    throw new LogicException(
                        sprintf(
                            'Arguments for array-specified validators must be an array, you provided %s', $v
                        )
                    );
                $validatorArgs = empty($v) ? array() : $v;
            }
            if (!empty($prefix))
                $validatorName = $prefix . '\\' . $validatorName;
            $this->addValidator($validatorName, $validatorArgs);
        }
    }

    public function getValidators()
    {
        return $this->validators;
    }

    protected function iterateValidation($input)
    {
        $validators = $this->getValidators();
        $exceptions = array();
        foreach ($validators as $v)
            try {
                $v->validate($input);
            } catch (InvalidException $e) {
                $exceptions[] = $e;
            }
        return $exceptions;
    }

    public function validate($input)
    {
        $exceptions = $this->iterateValidation($input);
        if (!empty($exceptions))
            throw new InvalidException($exceptions);
        return true;
    }

    public function validateOne($input)
    {
        $validators = $this->getValidators();
        $exceptions = $this->iterateValidation($input);
        if (count($exceptions) === count($validators))
            throw new InvalidException($exceptions);
        return true;
    }

    public function isValid($input)
    {
        $validators = $this->getValidators();
        return count($validators) === count(array_filter(
                $validators, function($v) use($input) {
                    return $v->isValid($input);
                }
            ));
    }

    public function isOneValid($input)
    {
        return (boolean) array_filter(
            $this->getValidators(), function($v) use($input) {
                return $v->isValid($input);
            }
        );
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function setMessages(array $messages)
    {
        if (count($this->messages) != count($messages))
            throw new OutOfRangeException(
                'You must set exactly the same amount of messages currently present in the validator'
            );
        $this->messages = $messages;
    }

}