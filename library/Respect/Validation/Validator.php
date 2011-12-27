<?php

namespace Respect\Validation;

use ReflectionClass;
use ReflectionException;
use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Rules\AllOf;

/**
 * @method \Respect\Validation\Validator allOf()
 * @method \Respect\Validation\Validator alnum(string $additionalChars = null)
 * @method \Respect\Validation\Validator alpha(string $additionalChars = null)
 * @method \Respect\Validation\Validator arr()
 * @method \Respect\Validation\Validator attribute(string $reference, Validatable $validator = null, bool $mandatory = true)
 * @method \Respect\Validation\Validator between(int $min = null, int $max = null, bool $inclusive = false)
 * @method \Respect\Validation\Validator bool()
 * @method \Respect\Validation\Validator call()
 * @method \Respect\Validation\Validator callback(mixed $callback)
 * @method \Respect\Validation\Validator contains(mixed $containsValue, bool $identical = false)
 * @method \Respect\Validation\Validator cpf()
 * @method \Respect\Validation\Validator date(string $format = null)
 * @method \Respect\Validation\Validator digits(string $additionalChars = null)
 * @method \Respect\Validation\Validator domain()
 * @method \Respect\Validation\Validator each(Validatable $itemValidator = null, Validatable $keyValidator = null)
 * @method \Respect\Validation\Validator email()
 * @method \Respect\Validation\Validator endsWith(mixed $endValue, bool $identical = false)
 * @method \Respect\Validation\Validator equals(mixed $compareTo, bool $compareIdentical=false)
 * @method \Respect\Validation\Validator float()
 * @method \Respect\Validation\Validator hexa()
 * @method \Respect\Validation\Validator in(array $haystack, bool $compareIdentical = false)
 * @method \Respect\Validation\Validator instance(string $instanceName)
 * @method \Respect\Validation\Validator int()
 * @method \Respect\Validation\Validator ip(array $ipOptions = null)
 * @method \Respect\Validation\Validator json()
 * @method \Respect\Validation\Validator key(string $reference, Validatable $referenceValidator = null, bool $mandatory = true)
 * @method \Respect\Validation\Validator length(int $min=null, int $max=null, bool $inclusive = true)
 * @method \Respect\Validation\Validator max(int $maxValue, bool $inclusive = false)
 * @method \Respect\Validation\Validator min(int $minValue, bool $inclusive = false)
 * @method \Respect\Validation\Validator multiple(int $multipleOf)
 * @method \Respect\Validation\Validator negative()
 * @method \Respect\Validation\Validator noneOf()
 * @method \Respect\Validation\Validator not(Validatable $rule)
 * @method \Respect\Validation\Validator notEmpty()
 * @method \Respect\Validation\Validator noWhitespace()
 * @method \Respect\Validation\Validator nullValue()
 * @method \Respect\Validation\Validator numeric()
 * @method \Respect\Validation\Validator object()
 * @method \Respect\Validation\Validator oneOf()
 * @method \Respect\Validation\Validator positive()
 * @method \Respect\Validation\Validator regex($regex)
 * @method \Respect\Validation\Validator sf(string $name, array $params = null)
 * @method \Respect\Validation\Validator startsWith(mixed $startValue, bool $identical = false)
 * @method \Respect\Validation\Validator string()
 * @method \Respect\Validation\Validator tld()
 * @method \Respect\Validation\Validator zend(mixed $validator, array $params = null)
 */
class Validator extends AllOf
{

    public static function __callStatic($ruleName, $arguments)
    {
        if ('allOf' === $ruleName)
            return static::buildRule($ruleName, $arguments);

        $validator = new static;
        return $validator->__call($ruleName, $arguments);
    }

    public static function buildRule($ruleSpec, $arguments=array())
    {
        if ($ruleSpec instanceof Validatable)
            return $ruleSpec;
        try {
            $validatorFqn = 'Respect\\Validation\\Rules\\' . ucfirst($ruleSpec);
            $validatorClass = new ReflectionClass($validatorFqn);
            $validatorInstance = $validatorClass->newInstanceArgs(
                    $arguments
            );

            return $validatorInstance;
        } catch (ReflectionException $e) {
            throw new ComponentException($e->getMessage());
        }
    }

    public function __call($method, $arguments)
    {
        $this->addRule(static::buildRule($method, $arguments));
        return $this;
    }

    public function reportError($input, array $extraParams=array())
    {
        $exception = new AllOfException;
        $input = AllOfException::stringify($input);
        $name = $this->getName() ? : "\"$input\"";
        $params = array_merge(
            $extraParams, get_object_vars($this), get_class_vars(__CLASS__)
        );
        $exception->configure($name, $params);
        if (!is_null($this->template))
            $exception->setTemplate($this->template);
        return $exception;
    }

    /**
     * Create instance validator
     *
     * @static
     * @return \Respect\Validation\Validator
     */
    public static function create() {
        $ref = new ReflectionClass(__CLASS__);
        return $ref->newInstanceArgs(func_get_args());
    }
}

/**
 * LICENSE
 *
 * Copyright (c) 2009-2011, Alexandre Gomes Gaigalas.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright notice,
 *       this list of conditions and the following disclaimer.
 *
 *     * Redistributions in binary form must reproduce the above copyright notice,
 *       this list of conditions and the following disclaimer in the documentation
 *       and/or other materials provided with the distribution.
 *
 *     * Neither the name of Alexandre Gomes Gaigalas nor the names of its
 *       contributors may be used to endorse or promote products derived from this
 *       software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */
