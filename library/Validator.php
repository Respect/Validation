<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation;

use finfo;
use Respect\Validation\Rules\AllOf;
use Respect\Validation\Rules\Key;

/**
 * @method static Validator age(int $minAge = null, int $maxAge = null)
 * @method static Validator allOf(Rule ...$rule)
 * @method static Validator alnum(string $additionalChars = null)
 * @method static Validator alpha(string $additionalChars = null)
 * @method static Validator alwaysInvalid()
 * @method static Validator alwaysValid()
 * @method static Validator anyOf(Rule ...$rule)
 * @method static Validator arrayType()
 * @method static Validator arrayVal()
 * @method static Validator attribute(string $attributeName, Rule $rule = null, bool $mandatory = true)
 * @method static Validator base()
 * @method static Validator base64()
 * @method static Validator between(mixed $min = null, mixed $max = null, bool $inclusive = true)
 * @method static Validator boolType()
 * @method static Validator boolVal()
 * @method static Validator bsn()
 * @method static Validator call(callable $callable, Rule $rule)
 * @method static Validator callableType()
 * @method static Validator callback(mixed $callback)
 * @method static Validator charset(mixed $charset)
 * @method static Validator cnh()
 * @method static Validator cnpj()
 * @method static Validator consonant(string $additionalChars = null)
 * @method static Validator contains(mixed $expectedValue, bool $identical = false)
 * @method static Validator countable()
 * @method static Validator countryCode()
 * @method static Validator currencyCode()
 * @method static Validator cpf()
 * @method static Validator creditCard(string $brand = null)
 * @method static Validator dateTime(string $format = null)
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
 * @method static Validator key(mixed $key, Rule $rule = null, bool $mandatory = true)
 * @method static Validator keyNested(string $reference, Validatable $referenceValidator = null, bool $mandatory = true)
 * @method static Validator keySet(Key ...$rule)
 * @method static Validator keyValue(string $comparedKey, string $ruleName, string $baseKey)
 * @method static Validator languageCode(string $set)
 * @method static Validator leapDate(string $format)
 * @method static Validator leapYear()
 * @method static Validator length(int $min = null, int $max = null, bool $inclusive = true)
 * @method static Validator lowercase()
 * @method static Validator luhn()
 * @method static Validator macAddress()
 * @method static Validator max(mixed $maxValue, bool $inclusive = true)
 * @method static Validator mimetype(string $mimetype)
 * @method static Validator min(mixed $minValue, bool $inclusive = true)
 * @method static Validator minimumAge(int $age, bool $format = null)
 * @method static Validator multiple(int $multipleOf)
 * @method static Validator negative()
 * @method static Validator nif()
 * @method static Validator no($useLocale = false)
 * @method static Validator noneOf(Rule ...$rule)
 * @method static Validator not(Rule $rule)
 * @method static Validator notBlank()
 * @method static Validator notEmpty()
 * @method static Validator notOptional()
 * @method static Validator noWhitespace()
 * @method static Validator nullType()
 * @method static Validator number()
 * @method static Validator numericVal()
 * @method static Validator objectType()
 * @method static Validator odd()
 * @method static Validator oneOf(Rule ...$rule)
 * @method static Validator optional(Validatable $rule)
 * @method static Validator perfectSquare()
 * @method static Validator pesel()
 * @method static Validator phone()
 * @method static Validator phpLabel()
 * @method static Validator pis()
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
 * @method static Validator stringVal()
 * @method static Validator subdivisionCode(string $countryCode)
 * @method static Validator symbolicLink()
 * @method static Validator tld()
 * @method static Validator trueVal()
 * @method static Validator type(string $type)
 * @method static Validator unique()
 * @method static Validator uploaded()
 * @method static Validator uppercase()
 * @method static Validator url()
 * @method static Validator uuid()
 * @method static Validator vatin(string $countryCode)
 * @method static Validator version()
 * @method static Validator videoUrl(string $service = null)
 * @method static Validator vowel()
 * @method static Validator when(Validatable $if, Validatable $then, Validatable $when = null)
 * @method static Validator writable()
 * @method static Validator xdigit(string $additionalChars = null)
 * @method static Validator yes($useLocale = false)
 * @method static Validator zend(mixed $validator, array $params = null)
 */
final class Validator implements Rule
{
    /**
     * @var Rule[]
     */
    private $rules = [];

    /**
     * @var Factory
     */
    private $factory;

    /**
     * @var string
     */
    private $locale;

    public function __construct(Factory $factory, string $locale)
    {
        $this->factory = $factory;
        $this->locale = $locale;
    }

    private function rule(): Rule
    {
        if (1 === count($this->rules)) {
            return current($this->rules);
        }

        return new AllOf(...$this->rules);
    }

    public function addRules(array $rules): void
    {
        foreach ($rules as $rule) {
            $this->addRule($rule);
        }
    }

    private function addRule(Rule $rule): void
    {
        $this->rules[] = $rule;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($input): Result
    {
        return $this->rule()->apply($input);
    }

    public static function create(): self
    {
        return new static(Factory::getDefaultInstance(), 'en');
    }

    public static function __callStatic($ruleName, $arguments): self
    {
        return self::create()->__call($ruleName, $arguments);
    }

    public function __call(string $name, array $parameters): self
    {
        $this->addRule($this->factory->rule($name, $parameters));

        return $this;
    }

    public function isValid($input): bool
    {
        $result = $this->apply($input);

        return $result->isValid();
    }

    public function validate($input): Validation
    {
        $result = $this->apply($input);

        return new Validation($result, $this->factory, $this->locale);
    }

    public function assert($input): void
    {
        $validation = $this->validate($input);

        if ($validation->isValid()) {
            return;
        }

        throw $this->factory->exception($validation->getMainMessage());
    }

    public function assertAll($input): void
    {
        $validation = $this->validate($input);

        if ($validation->isValid()) {
            return;
        }

        throw $this->factory->exception($validation->getFullMessage());
    }
}
