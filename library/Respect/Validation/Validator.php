<?php

namespace Respect\Validation;

use ReflectionClass;

abstract class Validator
{

    public static function validate($input, $validatorName)
    {
        $arguments = func_get_args();
        $arguments = array_slice($arguments, 2);
        return static::buildValidator($validatorName, $arguments)->validate($input);
    }

    public static function is($input, $validatorName)
    {
        $arguments = func_get_args();
        $arguments = array_slice($arguments, 2);
        return static::buildValidator($validatorName, $arguments)->isValid($input);
    }

    public static function __callStatic($method, $arguments)
    {
        if (2 > count($arguments))
            return false;
        if (0 === strpos($method, 'valid')) {
            $arguments[1] = substr($method, 5) . '\\' . $arguments[1];
            $arguments[1] = trim($arguments[1], '\\');
            return call_user_func_array(
                array(get_called_class(), 'validate'), $arguments
            );
        } elseif (0 === strpos($method, 'is')) {
            $arguments[1] = substr($method, 2) . '\\' . $arguments[1];
            $arguments[1] = trim($arguments[1], '\\');
            return call_user_func_array(
                array(get_called_class(), 'is'), $arguments
            );
        }
        return false;
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
        $validatorFqn = array_merge($validatorFqn, explode('\\', $validator));
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