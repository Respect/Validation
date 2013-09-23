<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ValidationException;

class Assoc extends AbstractRule
{
    private $rules = array();
    private $defaultRule;

    public function __construct(array $rules, AbstractRule $defaultRule = null)
    {
        foreach ($rules as $key => $value) {
            $this->rules[$key] = new AllOf($value);
        }

        if (null === $defaultRule) {
            $defaultRule = new AlwaysValid();
        }

        $this->defaultRule = $defaultRule;
    }

    public function assert($input)
    {
        $exceptions = array();
        try {
            $arr = new Arr();
            $arr->assert($input);
        } catch (ValidationException $exception) {
            $exceptions[] = $exception;
        }

        foreach ($input as $key => $value) {
            try {
                $rule = isset($this->rules[$key]) ? $this->rules[$key] : $this->defaultRule;
                $rule->assert($value);
            } catch (ValidationException $exception) {
                $exception->configure($key);

                $exceptions[] = $exception;
            }
        }

        $numRules = count($this->rules) + 2;
        $numExceptions = count($exceptions);
        $summary = array(
            'total' => $numRules,
            'failed' => $numExceptions,
            'passed' => $numRules - $numExceptions
        );

        if (!empty($exceptions)) {
            throw $this->reportError($input, $summary)->setRelated($exceptions);
        }

        return true;
    }

    public function check($input)
    {
        $arr = new Arr();
        $arr->check($input);

        foreach ($input as $key => $value) {
            $rule = isset($this->rules[$key]) ? $this->rules[$key] : $this->defaultRule;
            try {
                $rule->check($value);
            } catch (ValidationException $exception) {
                $exception->configure($key);

                throw $exception;
            }
        }

        return true;
    }

    public function validate($input)
    {
        if (!is_array($input)) {
            return false;
        }

        foreach ($input as $key => $value) {
            $rule = isset($this->rules[$key]) ? $this->rules[$key] : $this->defaultRule;
            if (false === $rule->validate($value)) {
                return false;
            }
        }

        return true;
    }
}
