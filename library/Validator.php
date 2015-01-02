<?php
namespace Respect\Validation;

use ReflectionClass;
use ReflectionException;
use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Rules\AllOf;

/**
 * @method static \Respect\Validation\Validator allOf()
 * @method static \Respect\Validation\Validator alnum(string $additionalChars = null)
 * @method static \Respect\Validation\Validator alpha(string $additionalChars = null)
 * @method static \Respect\Validation\Validator alwaysInvalid()
 * @method static \Respect\Validation\Validator alwaysValid()
 * @method static \Respect\Validation\Validator arr()
 * @method static \Respect\Validation\Validator attribute(string $reference, Validatable $validator = null, bool $mandatory = true)
 * @method static \Respect\Validation\Validator base()
 * @method static \Respect\Validation\Validator between(int $min = null, int $max = null, bool $inclusive = false)
 * @method static \Respect\Validation\Validator bool()
 * @method static \Respect\Validation\Validator call()
 * @method static \Respect\Validation\Validator callback(mixed $callback)
 * @method static \Respect\Validation\Validator charset(array $charset)
 * @method static \Respect\Validation\Validator cnh()
 * @method static \Respect\Validation\Validator cnpj()
 * @method static \Respect\Validation\Validator consonant(string $additionalChars = null)
 * @method static \Respect\Validation\Validator contains(mixed $containsValue, bool $identical = false)
 * @method static \Respect\Validation\Validator countryCode()
 * @method static \Respect\Validation\Validator cpf()
 * @method static \Respect\Validation\Validator creditCard()
 * @method static \Respect\Validation\Validator date(string $format = null)
 * @method static \Respect\Validation\Validator digit(string $additionalChars = null)
 * @method static \Respect\Validation\Validator directory()
 * @method static \Respect\Validation\Validator domain()
 * @method static \Respect\Validation\Validator each(Validatable $itemValidator = null, Validatable $keyValidator = null)
 * @method static \Respect\Validation\Validator email()
 * @method static \Respect\Validation\Validator endsWith(mixed $endValue, bool $identical = false)
 * @method static \Respect\Validation\Validator equals(mixed $compareTo, bool $compareIdentical=false)
 * @method static \Respect\Validation\Validator even()
 * @method static \Respect\Validation\Validator executable()
 * @method static \Respect\Validation\Validator exists()
 * @method static \Respect\Validation\Validator file()
 * @method static \Respect\Validation\Validator float()
 * @method static \Respect\Validation\Validator graph(string $additionalChars = null)
 * @method static \Respect\Validation\Validator in(array $haystack, bool $compareIdentical = false)
 * @method static \Respect\Validation\Validator instance(string $instanceName)
 * @method static \Respect\Validation\Validator int()
 * @method static \Respect\Validation\Validator ip(array $ipOptions = null)
 * @method static \Respect\Validation\Validator json()
 * @method static \Respect\Validation\Validator key(string $reference, Validatable $referenceValidator = null, bool $mandatory = true)
 * @method static \Respect\Validation\Validator leapDate(mixed $format)
 * @method static \Respect\Validation\Validator leapYear()
 * @method static \Respect\Validation\Validator length(int $min=null, int $max=null, bool $inclusive = true)
 * @method static \Respect\Validation\Validator lowercase()
 * @method static \Respect\Validation\Validator macAddress()
 * @method static \Respect\Validation\Validator max(int $maxValue, bool $inclusive = false)
 * @method static \Respect\Validation\Validator min(int $minValue, bool $inclusive = false)
 * @method static \Respect\Validation\Validator minimumAge(int $age)
 * @method static \Respect\Validation\Validator multiple(int $multipleOf)
 * @method static \Respect\Validation\Validator negative()
 * @method static \Respect\Validation\Validator noneOf()
 * @method static \Respect\Validation\Validator not(Validatable $rule)
 * @method static \Respect\Validation\Validator notEmpty()
 * @method static \Respect\Validation\Validator noWhitespace()
 * @method static \Respect\Validation\Validator nullValue()
 * @method static \Respect\Validation\Validator numeric()
 * @method static \Respect\Validation\Validator object()
 * @method static \Respect\Validation\Validator odd()
 * @method static \Respect\Validation\Validator oneOf()
 * @method static \Respect\Validation\Validator perfectSquare()
 * @method static \Respect\Validation\Validator phone()
 * @method static \Respect\Validation\Validator positive()
 * @method static \Respect\Validation\Validator postalCode($countryCode)
 * @method static \Respect\Validation\Validator primeNumber()
 * @method static \Respect\Validation\Validator prnt(string $additionalChars = null)
 * @method static \Respect\Validation\Validator punct(string $additionalChars = null)
 * @method static \Respect\Validation\Validator readable()
 * @method static \Respect\Validation\Validator regex($regex)
 * @method static \Respect\Validation\Validator roman()
 * @method static \Respect\Validation\Validator sf(string $name, array $params = null)
 * @method static \Respect\Validation\Validator slug()
 * @method static \Respect\Validation\Validator space(string $additionalChars = null)
 * @method static \Respect\Validation\Validator startsWith(mixed $startValue, bool $identical = false)
 * @method static \Respect\Validation\Validator string()
 * @method static \Respect\Validation\Validator symbolicLink()
 * @method static \Respect\Validation\Validator tld()
 * @method static \Respect\Validation\Validator uploaded()
 * @method static \Respect\Validation\Validator uppercase()
 * @method static \Respect\Validation\Validator version()
 * @method static \Respect\Validation\Validator vowel()
 * @method static \Respect\Validation\Validator when(Validatable $if, Validatable $then, Validatable $when)
 * @method static \Respect\Validation\Validator writable()
 * @method static \Respect\Validation\Validator xdigit(string $additionalChars = null)
 * @method static \Respect\Validation\Validator zend(mixed $validator, array $params = null)
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

