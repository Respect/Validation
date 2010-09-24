<?php

namespace Respect\Validation;

class CompositeValidator extends AbstractNode implements Validatable
{

    protected $validators = array();

    protected function appendValidator(Validatable $validator)
    {
        $this->validators[spl_object_hash($validator)] = $validator;
        $this->messages = array_merge(
            $this->messages, $validator->getMessages()
        );
    }

    public function addValidator($validator, $arguments=array())
    {
        $this->appendValidator(Validator::buildValidator($validator, $arguments));
    }

    public function hasValidator($validator)
    {
        if (empty($this->validators))
            return false;
        if ($validator instanceof Valitatable)
            return isset($this->validators[spl_object_hash($validator)]);
        else
            return (boolean) array_filter(
                $this->validators,
                function($v) use ($validator) {
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
                $validators,
                function($v) use($input) {
                    return $v->isValid($input);
                }
            ));
    }

    public function isOneValid($input)
    {
        return (boolean) array_filter(
            $this->getValidators(),
            function($v) use($input) {
                return $v->isValid($input);
            }
        );
    }

}