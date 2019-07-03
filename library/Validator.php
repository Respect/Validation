<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation;

use finfo;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Rules\AllOf;
use Respect\Validation\Rules\Key;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use function count;

/**
 * @method static Validator allOf(Validatable ...$rule)
 * @method static Validator alnum(string ...$additionalChars)
 * @method static Validator alpha(string ...$additionalChars)
 * @method static Validator alwaysInvalid()
 * @method static Validator alwaysValid()
 * @method static Validator anyOf(Validatable ...$rule)
 * @method static Validator arrayType()
 * @method static Validator arrayVal()
 * @method static Validator attribute(string $reference, Validatable $validator = null, bool $mandatory = true)
 * @method static Validator base(int $base, string $chars = null)
 * @method static Validator base64()
 * @method static Validator between($minimum, $maximum)
 * @method static Validator bic(string $countryCode)
 * @method static Validator boolType()
 * @method static Validator boolVal()
 * @method static Validator bsn()
 * @method static Validator call(callable $callable, Validatable $rule)
 * @method static Validator callableType()
 * @method static Validator callback(callable $callback)
 * @method static Validator charset(string ...$charset)
 * @method static Validator cnh()
 * @method static Validator cnpj()
 * @method static Validator control(string ...$additionalChars)
 * @method static Validator consonant(string ...$additionalChars)
 * @method static Validator contains($containsValue, bool $identical = false)
 * @method static Validator containsAny(array $needles, bool $strictCompareArray = false)
 * @method static Validator countable()
 * @method static Validator countryCode(string $set = null)
 * @method static Validator currencyCode()
 * @method static Validator cpf()
 * @method static Validator creditCard(string $brand = null)
 * @method static Validator date(string $format = 'Y-m-d')
 * @method static Validator dateTime(string $format = null)
 * @method static Validator digit(string ...$additionalChars)
 * @method static Validator directory()
 * @method static Validator domain(bool $tldCheck = true)
 * @method static Validator each(Validatable $rule)
 * @method static Validator email()
 * @method static Validator endsWith($endValue, bool $identical = false)
 * @method static Validator equals($compareTo)
 * @method static Validator equivalent($compareTo)
 * @method static Validator even()
 * @method static Validator executable()
 * @method static Validator exists()
 * @method static Validator extension(string $extension)
 * @method static Validator factor(int $dividend)
 * @method static Validator falseVal()
 * @method static Validator fibonacci()
 * @method static Validator file()
 * @method static Validator filterVar(int $filter, $options = null)
 * @method static Validator finite()
 * @method static Validator floatVal()
 * @method static Validator floatType()
 * @method static Validator graph(string ...$additionalChars)
 * @method static Validator greaterThan($compareTo)
 * @method static Validator hexRgbColor()
 * @method static Validator iban()
 * @method static Validator identical($value)
 * @method static Validator image(finfo $fileInfo = null)
 * @method static Validator imei()
 * @method static Validator in($haystack, bool $compareIdentical = false)
 * @method static Validator infinite()
 * @method static Validator instance(string $instanceName)
 * @method static Validator intVal()
 * @method static Validator intType()
 * @method static Validator ip(string $range = '*', int $options = null)
 * @method static Validator isbn()
 * @method static Validator iterableType()
 * @method static Validator json()
 * @method static Validator key(string $reference, Validatable $referenceValidator = null, bool $mandatory = true)
 * @method static Validator keyNested(string $reference, Validatable $referenceValidator = null, bool $mandatory = true)
 * @method static Validator keySet(Key ...$rule)
 * @method static Validator keyValue(string $comparedKey, string $ruleName, string $baseKey)
 * @method static Validator languageCode(string $set = null)
 * @method static Validator leapDate(string $format)
 * @method static Validator leapYear()
 * @method static Validator length(int $min = null, int $max = null, bool $inclusive = true)
 * @method static Validator lowercase()
 * @method static Validator lessThan($compareTo)
 * @method static Validator luhn()
 * @method static Validator macAddress()
 * @method static Validator max($compareTo)
 * @method static Validator maxAge(int $age, string $format = null)
 * @method static Validator mimetype(string $mimetype)
 * @method static Validator min($compareTo)
 * @method static Validator minAge(int $age, string $format = null)
 * @method static Validator multiple(int $multipleOf)
 * @method static Validator negative()
 * @method static Validator nfeAccessKey()
 * @method static Validator nif()
 * @method static Validator nip()
 * @method static Validator no($useLocale = false)
 * @method static Validator noneOf(Validatable ...$rule)
 * @method static Validator not(Validatable $rule)
 * @method static Validator notBlank()
 * @method static Validator notEmoji()
 * @method static Validator notEmpty()
 * @method static Validator notOptional()
 * @method static Validator noWhitespace()
 * @method static Validator nullable(Validatable $rule)
 * @method static Validator nullType()
 * @method static Validator number()
 * @method static Validator numericVal()
 * @method static Validator objectType()
 * @method static Validator odd()
 * @method static Validator oneOf(Validatable ...$rule)
 * @method static Validator optional(Validatable $rule)
 * @method static Validator perfectSquare()
 * @method static Validator pesel()
 * @method static Validator phone()
 * @method static Validator phpLabel()
 * @method static Validator pis()
 * @method static Validator polishIdCard()
 * @method static Validator positive()
 * @method static Validator postalCode(string $countryCode)
 * @method static Validator primeNumber()
 * @method static Validator printable(string ...$additionalChars)
 * @method static Validator punct(string ...$additionalChars)
 * @method static Validator readable()
 * @method static Validator regex(string $regex)
 * @method static Validator resourceType()
 * @method static Validator roman()
 * @method static Validator scalarVal()
 * @method static Validator sf(Constraint $constraint, ValidatorInterface $validator = null)
 * @method static Validator size(string $minSize = null, string $maxSize = null)
 * @method static Validator slug()
 * @method static Validator sorted(string $direction)
 * @method static Validator space(string ...$additionalChars)
 * @method static Validator startsWith($startValue, bool $identical = false)
 * @method static Validator stringType()
 * @method static Validator stringVal()
 * @method static Validator subdivisionCode(string $countryCode)
 * @method static Validator subset(array $superset)
 * @method static Validator symbolicLink()
 * @method static Validator time(string $format = 'H:i:s')
 * @method static Validator tld()
 * @method static Validator trueVal()
 * @method static Validator type(string $type)
 * @method static Validator unique()
 * @method static Validator uploaded()
 * @method static Validator uppercase()
 * @method static Validator url()
 * @method static Validator uuid(int $version = null)
 * @method static Validator version()
 * @method static Validator videoUrl(string $service = null)
 * @method static Validator vowel(string ...$additionalChars)
 * @method static Validator when(Validatable $if, Validatable $then, Validatable $else = null)
 * @method static Validator writable()
 * @method static Validator xdigit(string ...$additionalChars)
 * @method static Validator yes($useLocale = false)
 * @method static Validator zend($validator, array $params = null)
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Validator extends AllOf
{
    /**
     * {@inheritDoc}
     */
    public function check($input): void
    {
        try {
            parent::check($input);
        } catch (ValidationException $exception) {
            if (count($this->getRules()) == 1 && $this->template) {
                $exception->updateTemplate($this->template);
            }

            throw $exception;
        }
    }

    /**
     * Creates a new Validator instance with a rule that was called on the static method.
     *
     * @param mixed[] $arguments
     *
     * @throws ComponentException
     */
    public static function __callStatic(string $ruleName, array $arguments): self
    {
        return self::create()->__call($ruleName, $arguments);
    }

    /**
     * Create a new rule by the name of the method and adds the rule to the chain.
     *
     * @param mixed[] $arguments
     *
     * @throws ComponentException
     */
    public function __call(string $ruleName, array $arguments): self
    {
        $this->addRule(Factory::getDefaultInstance()->rule($ruleName, $arguments));

        return $this;
    }

    /**
     * Create instance validator.
     */
    public static function create(): self
    {
        return new self();
    }
}
