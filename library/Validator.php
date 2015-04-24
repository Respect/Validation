<?php
namespace Respect\Validation;

use ReflectionClass;
use ReflectionException;
use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Rules\AllOf;

/**
 * @method static Validator age(int $minAge = null, int $maxAge = null)
 * @method static Validator allOf()
 * @method static Validator alnum(string $additionalChars = null)
 * @method static Validator alpha(string $additionalChars = null)
 * @method static Validator alwaysInvalid()
 * @method static Validator alwaysValid()
 * @method static Validator arr()
 * @method static Validator attribute(string $reference, Validatable $validator = null, bool $mandatory = true)
 * @method static Validator bank(string $countryCode)
 * @method static Validator bankAccount(string $countryCode)
 * @method static Validator base()
 * @method static Validator between(mixed $min = null, mixed $max = null, bool $inclusive = false)
 * @method static Validator bic(string $countryCode)
 * @method static Validator bool()
 * @method static Validator call()
 * @method static Validator callback(mixed $callback)
 * @method static Validator charset(mixed $charset)
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
 * @method static Validator equals(mixed $compareTo, bool $compareIdentical = false)
 * @method static Validator even()
 * @method static Validator executable()
 * @method static Validator exists()
 * @method static Validator false()
 * @method static Validator file()
 * @method static Validator filterVar(int $filter, mixed $options = null)
 * @method static Validator float()
 * @method static Validator graph(string $additionalChars = null)
 * @method static Validator hexRgbColor()
 * @method static Validator in(mixed $haystack, bool $compareIdentical = false)
 * @method static Validator instance(string $instanceName)
 * @method static Validator int()
 * @method static Validator ip(mixed $ipOptions = null)
 * @method static Validator json()
 * @method static Validator key(string $reference, Validatable $referenceValidator = null, bool $mandatory = true)
 * @method static Validator leapDate(string $format)
 * @method static Validator leapYear()
 * @method static Validator length(int $min = null, int $max = null, bool $inclusive = true)
 * @method static Validator lowercase()
 * @method static Validator macAddress()
 * @method static Validator max(mixed $maxValue, bool $inclusive = false)
 * @method static Validator min(mixed $minValue, bool $inclusive = false)
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
 * @method static Validator postalCode(string $countryCode)
 * @method static Validator primeNumber()
 * @method static Validator prnt(string $additionalChars = null)
 * @method static Validator punct(string $additionalChars = null)
 * @method static Validator readable()
 * @method static Validator regex(string $regex)
 * @method static Validator roman()
 * @method static Validator sf(string $name, array $params = null)
 * @method static Validator slug()
 * @method static Validator space(string $additionalChars = null)
 * @method static Validator startsWith(mixed $startValue, bool $identical = false)
 * @method static Validator string()
 * @method static Validator symbolicLink()
 * @method static Validator tld()
 * @method static Validator true()
 * @method static Validator type(string $type)
 * @method static Validator uploaded()
 * @method static Validator uppercase()
 * @method static Validator url()
 * @method static Validator version()
 * @method static Validator vowel()
 * @method static Validator when(Validatable $if, Validatable $then, Validatable $when = null)
 * @method static Validator writable()
 * @method static Validator xdigit(string $additionalChars = null)
 * @method static Validator yes($useLocale = false)
 * @method static Validator zend(mixed $validator, array $params = null)
 */
class Validator extends AllOf
{
    protected static $factory;

    /**
     * @return Factory
     */
    protected static function getFactory()
    {
        if (! static::$factory instanceof Factory) {
            static::$factory = new Factory();
        }

        return static::$factory;
    }

    /**
     * @param Factory $factory
     *
     * @return null
     */
    public static function setFactory($factory)
    {
        static::$factory = $factory;
    }

    /**
     * @param string $rulePrefix
     * @param bool   $prepend
     *
     * @return null
     */
    public static function with($rulePrefix, $prepend = false)
    {
        if (false === $prepend) {
            self::getFactory()->appendRulePrefix($rulePrefix);
        } else {
            self::getFactory()->prependRulePrefix($rulePrefix);
        }
    }

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
        try {
            return static::getFactory()->rule($ruleSpec, $arguments);
        } catch (\Exception $exception) {
            throw new ComponentException($exception->getMessage(), $exception->getCode(), $exception);
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
        if ('not' === $method && empty($arguments)) {
            return new static(new Rules\Not($this));
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
