<?php

namespace Respect\Validation\Rules;

use Exception;
use Respect\Validation\Validator;
use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;

abstract class AbstractComposite extends AbstractRule implements Validatable
{

    protected $rules = array();

    public function __construct()
    {
        $this->addRules(func_get_args());
    }

    protected function appendRule(Validatable $validator)
    {
        $this->rules[spl_object_hash($validator)] = $validator;
    }

    public function addRule($validator, $arguments=array())
    {
        $this->appendRule(
            Validator::buildRule($validator, $arguments)
        );
    }

    public function hasRule($validator)
    {
        if (empty($this->rules))
            return false;
        if ($validator instanceof Valitatable)
            return isset($this->rules[spl_object_hash($validator)]);
        else
            return (boolean) array_filter(
                $this->rules,
                function($v) use ($validator) {
                    return (integer) ($v instanceof $validator);
                });
    }

    public function addRules(array $validators, $prefix='')
    {
        foreach ($validators as $validatorKey => $validatorSpec) {
            if (is_object($validatorSpec)) {
                $this->addRule($validatorSpec);
                continue;
            } elseif (is_numeric($validatorKey)) {
                $validatorName = $validatorSpec;
                $validatorArgs = array();
            } else {
                $validatorName = $validatorKey;
                if (!empty($validatorSpec) && !is_array($validatorSpec))
                    throw new ComponentException(
                        sprintf(
                            'Arguments for array-specified validators must be an array, you provided %s',
                            $validatorSpec
                        )
                    );
                $validatorArgs = empty($validatorSpec) ? array() : $validatorSpec;
            }
            if (!empty($prefix))
                $validatorName = $prefix . '\\' . $validatorName;
            $this->addRule($validatorName, $validatorArgs);
        }
    }

    public function getRules()
    {
        return $this->rules;
    }

    protected function validateRules($input)
    {
        $validators = $this->getRules();
        $exceptions = array();
        foreach ($validators as $v)
            try {
                $v->assert($input);
            } catch (ValidationException $e) {
                $exceptions[] = $e;
            }
        return $exceptions;
    }

}