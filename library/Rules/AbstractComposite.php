<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;
use Respect\Validation\Validator;

abstract class AbstractComposite extends AbstractRule
{
    protected $rules = [];

    public function __construct()
    {
        $this->addRules(func_get_args());
    }

    public function setName($name)
    {
        $parentName = $this->getName();
        foreach ($this->rules as $rule) {
            $ruleName = $rule->getName();
            if ($ruleName && $parentName !== $ruleName) {
                continue;
            }

            $rule->setName($name);
        }

        return parent::setName($name);
    }

    public function addRule($validator, $arguments = [])
    {
        if (!$validator instanceof Validatable) {
            $this->appendRule(Validator::buildRule($validator, $arguments));
        } else {
            $this->appendRule($validator);
        }

        return $this;
    }

    public function removeRules()
    {
        $this->rules = [];
    }

    public function addRules(array $validators)
    {
        foreach ($validators as $key => $spec) {
            if ($spec instanceof Validatable) {
                $this->appendRule($spec);
            } elseif (is_numeric($key) && is_array($spec)) {
                $this->addRules($spec);
            } elseif (is_array($spec)) {
                $this->addRule($key, $spec);
            } else {
                $this->addRule($spec);
            }
        }

        return $this;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function hasRule($validator)
    {
        if (empty($this->rules)) {
            return false;
        }

        if ($validator instanceof Validatable) {
            return isset($this->rules[spl_object_hash($validator)]);
        }

        if (is_string($validator)) {
            foreach ($this->rules as $rule) {
                if (get_class($rule) == __NAMESPACE__.'\\'.$validator) {
                    return true;
                }
            }
        }

        return false;
    }

    protected function appendRule(Validatable $validator)
    {
        if (!$validator->getName() && $this->getName()) {
            $validator->setName($this->getName());
        }

        $this->rules[spl_object_hash($validator)] = $validator;
    }

    protected function validateRules($input)
    {
        $exceptions = [];
        foreach ($this->getRules() as $rule) {
            try {
                $rule->assert($input);
            } catch (ValidationException $exception) {
                $exceptions[] = $exception;
                $this->setExceptionTemplate($exception);
            }
        }

        return $exceptions;
    }

    private function setExceptionTemplate(ValidationException $exception)
    {
        if (null === $this->template || $exception->hasCustomTemplate()) {
            return;
        }

        $exception->setTemplate($this->template);

        if (!$exception instanceof NestedValidationException) {
            return;
        }

        foreach ($exception->getRelated() as $relatedException) {
            $this->setExceptionTemplate($relatedException);
        }
    }
}
