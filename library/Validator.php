<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation;

use finfo;
use ReflectionClass;
use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Rules\AllOf;
use Respect\Validation\Rules\Key;

/**
 * @method static Validator age(int $minAge = null, int $maxAge = null)
 * @method static Validator allOf(Validatable ...$rule)
 * @method static Validator alnum(string $additionalChars = null)
 * @method static Validator alpha(string $additionalChars = null)
 * @method static Validator alwaysInvalid()
 * @method static Validator alwaysValid()
 * @method static Validator arrayVal()
 * @method static Validator arrayType()
 * @method static Validator attribute(string $reference, Validatable $validator = null, bool $mandatory = true)
 * @method static Validator bank(string $countryCode)
 * @method static Validator bankAccount(string $countryCode)
 * @method static Validator base()
 * @method static Validator between(mixed $min = null, mixed $max = null, bool $inclusive = true)
 * @method static Validator bic(string $countryCode)
 * @method static Validator boolType()
 * @method static Validator boolVal()
 * @method static Validator bsn()
 * @method static Validator call()
 * @method static Validator callableType()
 * @method static Validator callback(mixed $callback)
 * @method static Validator charset(mixed $charset)
 * @method static Validator cnh()
 * @method static Validator cnpj()
 * @method static Validator consonant(string $additionalChars = null)
 * @method static Validator contains(mixed $containsValue, bool $identical = false)
 * @method static Validator countable()
 * @method static Validator countryCode()
 * @method static Validator currencyCode()
 * @method static Validator cpf()
 * @method static Validator creditCard(string $brand = null)
 * @method static Validator date(string $format = null)
 * @method static Validator digit(string $additionalChars = null)
 * @method static Validator directory()
 * @method static Validator domain(bool $tldCheck = true)
 * @method static Validator each(Validatable $itemValidator = null, Validatable $keyValidator = null)
 * @method static Validator email()
 * @method static Validator endsWith(mixed $endValue, bool $identical = false)
 * @method static Validator equals(mixed $compareTo)
 * @method static Validator even()
 * @method static Validator executable()
 * @method static Validator exists()
 * @method static Validator extension(string $extension)
 * @method static Validator factor(int $dividend)
 * @method static Validator falseVal()
 * @method static Validator fibonacci()
 * @method static Validator file()
 * @method static Validator filterVar(int $filter, mixed $options = null)
 * @method static Validator finite()
 * @method static Validator floatVal()
 * @method static Validator floatType()
 * @method static Validator graph(string $additionalChars = null)
 * @method static Validator hexRgbColor()
 * @method static Validator identical(mixed $value)
 * @method static Validator identityCard(string $countryCode)
 * @method static Validator image(finfo $fileInfo = null)
 * @method static Validator imei()
 * @method static Validator in(mixed $haystack, bool $compareIdentical = false)
 * @method static Validator infinite()
 * @method static Validator instance(string $instanceName)
 * @method static Validator intVal()
 * @method static Validator intType()
 * @method static Validator ip(mixed $ipOptions = null)
 * @method static Validator iterableType()
 * @method static Validator json()
 * @method static Validator key(string $reference, Validatable $referenceValidator = null, bool $mandatory = true)
 * @method static Validator keyNested(string $reference, Validatable $referenceValidator = null, bool $mandatory = true)
 * @method static Validator keySet(Key ...$rule)
 * @method static Validator keyValue(string $comparedKey, string $ruleName, string $baseKey)
 * @method static Validator languageCode(string $set)
 * @method static Validator leapDate(string $format)
 * @method static Validator leapYear()
 * @method static Validator length(int $min = null, int $max = null, bool $inclusive = true)
 * @method static Validator lowercase()
 * @method static Validator macAddress()
 * @method static Validator max(mixed $maxValue, bool $inclusive = true)
 * @method static Validator mimetype(string $mimetype)
 * @method static Validator min(mixed $minValue, bool $inclusive = true)
 * @method static Validator minimumAge(int $age)
 * @method static Validator multiple(int $multipleOf)
 * @method static Validator negative()
 * @method static Validator no($useLocale = false)
 * @method static Validator noneOf(Validatable ...$rule)
 * @method static Validator not(Validatable $rule)
 * @method static Validator notBlank()
 * @method static Validator notEmpty()
 * @method static Validator notOptional()
 * @method static Validator noWhitespace()
 * @method static Validator nullType()
 * @method static Validator numeric()
 * @method static Validator objectType()
 * @method static Validator odd()
 * @method static Validator oneOf(Validatable ...$rule)
 * @method static Validator optional(Validatable $rule)
 * @method static Validator perfectSquare()
 * @method static Validator pesel()
 * @method static Validator phone()
 * @method static Validator phpLabel()
 * @method static Validator positive()
 * @method static Validator postalCode(string $countryCode)
 * @method static Validator primeNumber()
 * @method static Validator prnt(string $additionalChars = null)
 * @method static Validator punct(string $additionalChars = null)
 * @method static Validator readable()
 * @method static Validator regex(string $regex)
 * @method static Validator resourceType()
 * @method static Validator roman()
 * @method static Validator scalarVal()
 * @method static Validator sf(string $name, array $params = null)
 * @method static Validator size(string $minSize = null, string $maxSize = null)
 * @method static Validator slug()
 * @method static Validator space(string $additionalChars = null)
 * @method static Validator startsWith(mixed $startValue, bool $identical = false)
 * @method static Validator stringType()
 * @method static Validator subdivisionCode(string $countryCode)
 * @method static Validator symbolicLink()
 * @method static Validator tld()
 * @method static Validator trueVal()
 * @method static Validator type(string $type)
 * @method static Validator uploaded()
 * @method static Validator uppercase()
 * @method static Validator url()
 * @method static Validator version()
 * @method static Validator videoUrl(string $service = null)
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
        if (!static::$factory instanceof Factory) {
            static::$factory = new Factory();
        }

        return static::$factory;
    }

    /**
     * @param Factory $factory
     */
    public static function setFactory($factory)
    {
        static::$factory = $factory;
    }

    /**
     * @param string $rulePrefix
     * @param bool   $prepend
     */
    public static function with($rulePrefix, $prepend = false)
    {
        if (false === $prepend) {
            self::getFactory()->appendRulePrefix($rulePrefix);
        } else {
            self::getFactory()->prependRulePrefix($rulePrefix);
        }
    }

    public function check($input)
    {
        try {
            return parent::check($input);
        } catch (ValidationException $exception) {
            if (count($this->getRules()) == 1 && $this->template) {
                $exception->setTemplate($this->template);
            }

            throw $exception;
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
    public static function buildRule($ruleSpec, $arguments = [])
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
        return $this->addRule(static::buildRule($method, $arguments));
    }

    protected function createException()
    {
        return new AllOfException();
    }

    /**
     * Create instance validator.
     *
     * @return Validator
     */
    public static function create()
    {
        $ref = new ReflectionClass(__CLASS__);

        return $ref->newInstanceArgs(func_get_args());
    }
}
