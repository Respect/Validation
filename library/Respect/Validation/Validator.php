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
 * @method \Respect\Validation\Validator alwaysInvalid()
 * @method \Respect\Validation\Validator alwaysValid()
 * @method \Respect\Validation\Validator arr()
 * @method \Respect\Validation\Validator attribute(string $reference, Validatable $validator = null, bool $mandatory = true)
 * @method \Respect\Validation\Validator base()
 * @method \Respect\Validation\Validator between(int $min = null, int $max = null, bool $inclusive = false)
 * @method \Respect\Validation\Validator bool()
 * @method \Respect\Validation\Validator call()
 * @method \Respect\Validation\Validator callback(mixed $callback)
 * @method \Respect\Validation\Validator charset(array $charset)
 * @method \Respect\Validation\Validator cnh()
 * @method \Respect\Validation\Validator cnpj()
 * @method \Respect\Validation\Validator consonant(string $additionalChars = null)
 * @method \Respect\Validation\Validator contains(mixed $containsValue, bool $identical = false)
 * @method \Respect\Validation\Validator countryCode()
 * @method \Respect\Validation\Validator cpf()
 * @method \Respect\Validation\Validator creditCard()
 * @method \Respect\Validation\Validator date(string $format = null)
 * @method \Respect\Validation\Validator digit(string $additionalChars = null)
 * @method \Respect\Validation\Validator directory()
 * @method \Respect\Validation\Validator domain()
 * @method \Respect\Validation\Validator each(Validatable $itemValidator = null, Validatable $keyValidator = null)
 * @method \Respect\Validation\Validator email()
 * @method \Respect\Validation\Validator endsWith(mixed $endValue, bool $identical = false)
 * @method \Respect\Validation\Validator equals(mixed $compareTo, bool $compareIdentical=false)
 * @method \Respect\Validation\Validator even()
 * @method \Respect\Validation\Validator exists()
 * @method \Respect\Validation\Validator file()
 * @method \Respect\Validation\Validator float()
 * @method \Respect\Validation\Validator graph(string $additionalChars = null)
 * @method \Respect\Validation\Validator in(array $haystack, bool $compareIdentical = false)
 * @method \Respect\Validation\Validator instance(string $instanceName)
 * @method \Respect\Validation\Validator int()
 * @method \Respect\Validation\Validator ip(array $ipOptions = null)
 * @method \Respect\Validation\Validator json()
 * @method \Respect\Validation\Validator key(string $reference, Validatable $referenceValidator = null, bool $mandatory = true)
 * @method \Respect\Validation\Validator leapDate(mixed $format)
 * @method \Respect\Validation\Validator leapYear()
 * @method \Respect\Validation\Validator length(int $min=null, int $max=null, bool $inclusive = true)
 * @method \Respect\Validation\Validator lowercase()
 * @method \Respect\Validation\Validator macAddress()
 * @method \Respect\Validation\Validator max(int $maxValue, bool $inclusive = false)
 * @method \Respect\Validation\Validator min(int $minValue, bool $inclusive = false)
 * @method \Respect\Validation\Validator minimumAge(int $age)
 * @method \Respect\Validation\Validator multiple(int $multipleOf)
 * @method \Respect\Validation\Validator negative()
 * @method \Respect\Validation\Validator noneOf()
 * @method \Respect\Validation\Validator not(Validatable $rule)
 * @method \Respect\Validation\Validator notEmpty()
 * @method \Respect\Validation\Validator noWhitespace()
 * @method \Respect\Validation\Validator nullValue()
 * @method \Respect\Validation\Validator numeric()
 * @method \Respect\Validation\Validator object()
 * @method \Respect\Validation\Validator odd()
 * @method \Respect\Validation\Validator oneOf()
 * @method \Respect\Validation\Validator perfectSquare()
 * @method \Respect\Validation\Validator phone()
 * @method \Respect\Validation\Validator positive()
 * @method \Respect\Validation\Validator primeNumber()
 * @method \Respect\Validation\Validator prnt(string $additionalChars = null)
 * @method \Respect\Validation\Validator punct(string $additionalChars = null)
 * @method \Respect\Validation\Validator readable()
 * @method \Respect\Validation\Validator regex($regex)
 * @method \Respect\Validation\Validator roman()
 * @method \Respect\Validation\Validator sf(string $name, array $params = null)
 * @method \Respect\Validation\Validator slug()
 * @method \Respect\Validation\Validator space(string $additionalChars = null)
 * @method \Respect\Validation\Validator startsWith(mixed $startValue, bool $identical = false)
 * @method \Respect\Validation\Validator string()
 * @method \Respect\Validation\Validator symbolicLink()
 * @method \Respect\Validation\Validator tld()
 * @method \Respect\Validation\Validator uploaded()
 * @method \Respect\Validation\Validator uppercase()
 * @method \Respect\Validation\Validator version()
 * @method \Respect\Validation\Validator vowel()
 * @method \Respect\Validation\Validator when(Validatable $if, Validatable $then, Validatable $when)
 * @method \Respect\Validation\Validator writable()
 * @method \Respect\Validation\Validator xdigit(string $additionalChars = null)
 * @method \Respect\Validation\Validator zend(mixed $validator, array $params = null)
 */
class Validator extends AllOf
{

    public static function __callStatic($ruleName, $arguments)
    {
        if ('allOf' === $ruleName) {
            return static::buildRule($ruleName, $arguments);
        }

        $validator = new static;

        return $validator->__call($ruleName, $arguments);
    }

    public static function buildRule($ruleSpec, $arguments=array())
    {
        if ($ruleSpec instanceof Validatable) {
            return $ruleSpec;
        }

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
        if ('not' === $method) {
            return $arguments ? static::buildRule($method, $arguments) : new Rules\Not($this);
        }

        if (isset($method{4}) &&
            substr($method, 0, 4) == 'base' && preg_match('@^base([0-9]{1,2})$@', $method, $match)) {
            return $this->addRule(static::buildRule('base', array($match[1])));
        }

        return $this->addRule(static::buildRule($method, $arguments));
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
        if (!is_null($this->template)) {
            $exception->setTemplate($this->template);
        }

        return $exception;
    }

    /**
     * Create instance validator
     *
     * @static
     * @return \Respect\Validation\Validator
     */
    public static function create()
    {
        $ref = new ReflectionClass(__CLASS__);

        return $ref->newInstanceArgs(func_get_args());
    }
}

