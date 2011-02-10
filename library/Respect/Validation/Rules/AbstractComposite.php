<?php

namespace Respect\Validation\Rules;

use Exception;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;
use Respect\Validation\Validator;

abstract class AbstractComposite extends AbstractRule implements Validatable
{

    protected $rules = array();

    public function __construct()
    {
        $this->addRules(func_get_args());
    }

    public function addRule($validator, $arguments=array())
    {
        if (!$validator instanceof Validatable)
            $validator = Validator::buildRule($validator, $arguments);
        $this->appendRule($validator);
    }

    public function addRules(array $validators)
    {
        foreach ($validators as $key => $spec) {
            if ($spec instanceof Validatable)
                $this->appendRule($spec);
            if (is_numeric($key) && is_array($spec))
                $this->addRules($spec);
            elseif (is_array($spec))
                $this->addRule($key, $spec);
            else
                $this->addRule($spec);
        }
    }
    
    public function getRules()
    {
        return $this->rules;
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

    protected function appendRule(Validatable $validator)
    {
        $this->rules[spl_object_hash($validator)] = $validator;
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
