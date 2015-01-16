<?php
namespace Respect\Validation;

use ReflectionClass;
use ReflectionException;
use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Rules\AllOf;

/**
 * @method static Validator allOf()
 * @method static Validator alnum(string $additionalChars = null)
 * @method static Validator alpha(string $additionalChars = null)
 * @method static Validator alwaysInvalid()
 * @method static Validator alwaysValid()
 * @method static Validator arr()
 * @method static Validator attribute(string $reference, Validatable $validator = null, bool $mandatory = true)
 * @method static Validator base()
 * @method static Validator between(int $min = null, int $max = null, bool $inclusive = false)
 * @method static Validator bool()
 * @method static Validator call()
 * @method static Validator callback(mixed $callback)
 * @method static Validator charset(array $charset)
 * @method static Validator cnh()
 * @method static Validator cnpj()
 * @method static Validator consonant(string $additionalChars = null)
 * @method static Validator contains(mixed $containsValue, bool $identical = false)
 * @method static Validator countryCode()
 * @method static Validator cpf()
 * @method static Validator creditCard()
 * @method static Validator date(string $format = null)
 * @method static Validator digit(string $additionalChars = null)
 * @method static Validator directory()
 * @method static Validator domain()
 * @method static Validator each(Validatable $itemValidator = null, Validatable $keyValidator = null)
 * @method static Validator email()
 * @method static Validator endsWith(mixed $endValue, bool $identical = false)
 * @method static Validator equals(mixed $compareTo, bool $compareIdentical=false)
 * @method static Validator even()
 * @method static Validator executable()
 * @method static Validator exists()
 * @method static Validator file()
 * @method static Validator float()
 * @method static Validator graph(string $additionalChars = null)
 * @method static Validator hexRgbColor()
 * @method static Validator in(array $haystack, bool $compareIdentical = false)
 * @method static Validator instance(string $instanceName)
 * @method static Validator int()
 * @method static Validator ip(array $ipOptions = null)
 * @method static Validator json()
 * @method static Validator key(string $reference, Validatable $referenceValidator = null, bool $mandatory = true)
 * @method static Validator leapDate(mixed $format)
 * @method static Validator leapYear()
 * @method static Validator length(int $min=null, int $max=null, bool $inclusive = true)
 * @method static Validator lowercase()
 * @method static Validator macAddress()
 * @method static Validator max(int $maxValue, bool $inclusive = false)
 * @method static Validator min(int $minValue, bool $inclusive = false)
 * @method static Validator minimumAge(int $age)
 * @method static Validator multiple(int $multipleOf)
 * @method static Validator negative()
 * @method static Validator no($useLocale = false)
 * @method static Validator noneOf()
 * @method static Validator not(Validatable $rule)
 * @method static Validator notEmpty()
 * @method static Validator noWhitespace()
 * @method static Validator nullValue()
 * @method static Validator numeric()
 * @method static Validator object()
 * @method static Validator odd()
 * @method static Validator oneOf()
 * @method static Validator perfectSquare()
 * @method static Validator phone()
 * @method static Validator positive()
 * @method static Validator postalCode($countryCode)
 * @method static Validator primeNumber()
 * @method static Validator prnt(string $additionalChars = null)
 * @method static Validator punct(string $additionalChars = null)
 * @method static Validator readable()
 * @method static Validator regex($regex)
 * @method static Validator roman()
 * @method static Validator sf(string $name, array $params = null)
 * @method static Validator slug()
 * @method static Validator space(string $additionalChars = null)
 * @method static Validator startsWith(mixed $startValue, bool $identical = false)
 * @method static Validator string()
 * @method static Validator symbolicLink()
 * @method static Validator tld()
 * @method static Validator uploaded()
 * @method static Validator uppercase()
 * @method static Validator version()
 * @method static Validator vowel()
 * @method static Validator when(Validatable $if, Validatable $then, Validatable $when)
 * @method static Validator writable()
 * @method static Validator xdigit(string $additionalChars = null)
 * @method static Validator yes($useLocale = false)
 * @method static Validator zend(mixed $validator, array $params = null)
 */
class Validator extends AllOf
{
    /**
     * @param string $ruleName
     * @param array  $arguments
     *
     * @return Validator
     */
    public static function __callStatic($ruleName, $arguments)
    {
        if ('allOf' === $ruleName) {
            return static::buildRule($ruleName, $arguments);
        }

        $validator = new static();

        return $validator->__call($ruleName, $arguments);
    }

    /**
     * @param mixed $ruleSpec
     * @param array $arguments
     *
     * @return Validatable
     */
    public static function buildRule($ruleSpec, $arguments = array())
    {
        if ($ruleSpec instanceof Validatable) {
            return $ruleSpec;
        }

        try {
            $validatorFqn = 'Respect\\Validation\\Rules\\'.ucfirst($ruleSpec);
            $validatorClass = new ReflectionClass($validatorFqn);
            $validatorInstance = $validatorClass->newInstanceArgs($arguments);

            return $validatorInstance;
        } catch (ReflectionException $e) {
            throw new ComponentException($e->getMessage());
        }
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return self
     */
    public function __call($method, $arguments)
    {
        if ('not' === $method) {
            return $arguments ? static::buildRule($method, $arguments) : new Rules\Not($this);
        }

        return $this->addRule(static::buildRule($method, $arguments));
    }


    /**
     * @param mixed $input
     * @param array $extraParams
     *
     * @return AllOfException
     */
    public function reportError($input, array $extraParams = array())
    {
        $exception = new AllOfException();
        $input = AllOfException::stringify($input);
        $name = $this->getName() ?: "\"$input\"";
        $params = array_merge(
            $extraParams,
            get_object_vars($this),
            get_class_vars(__CLASS__)
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
     * @return Validator
     */
    public static function create()
    {
        $ref = new ReflectionClass(__CLASS__);

        return $ref->newInstanceArgs(func_get_args());
    }
}
