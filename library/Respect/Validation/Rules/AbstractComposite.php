<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;
use Respect\Validation\Validator;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\InvalidException;
use Exception;

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
        $this->messages = array_merge(
            $this->messages, $validator->getMessages()
        );
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
        foreach ($validators as $k => $v) {
            if (is_object($v)) {
                $this->addRule($v);
                continue;
            } elseif (is_numeric($k)) {
                $validatorName = $v;
                $validatorArgs = array();
            } else {
                $validatorName = $k;
                if (!empty($v) && !is_array($v))
                    throw new ComponentException(
                        sprintf(
                            'Arguments for array-specified validators must be an array, you provided %s',
                            $v
                        )
                    );
                $validatorArgs = empty($v) ? array() : $v;
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

    protected function iterateRules($input)
    {
        $validators = $this->getRules();
        $exceptions = array();
        foreach ($validators as $v)
            try {
                $v->assert($input);
            } catch (Exception $e) {
                $exceptions[] = $e;
            }
        return $exceptions;
    }

}