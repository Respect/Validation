# Respect\Validation

[![Build Status](https://img.shields.io/travis/Respect/Validation/master.svg?style=flat-square)](http://travis-ci.org/Respect/Validation)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/Respect/Validation/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/Respect/Validation/?branch=master)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/Respect/Validation/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/Respect/Validation/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/respect/validation.svg?style=flat-square)](https://packagist.org/packages/respect/validation)
[![Total Downloads](https://img.shields.io/packagist/dt/respect/validation.svg?style=flat-square)](https://packagist.org/packages/respect/validation)
[![License](https://img.shields.io/packagist/l/respect/validation.svg?style=flat-square)](https://packagist.org/packages/respect/validation)

[The most awesome validation engine ever created for PHP.](http://bit.ly/1a1oeQv)

* Complex rules made simple: `v::numeric()->positive()->between(1, 256)->validate($myNumber)`.
* [Granularity control](https://github.com/Respect/Validation#validation-methods) for advanced reporting.
* Almost 100 (fully tested) validators.
* [A concrete API](https://gist.github.com/alganet/b66bc8281672ca3d3b42) for non fluent usage.

## Installation

Package is available on [Packagist](http://packagist.org/packages/respect/validation),
you can install it using [Composer](http://getcomposer.org).

```shell
composer require respect/validation
```

## Feature Guide

### Namespace Import

Respect\Validation is namespaced, but you can make your life easier by importing
a single class into your context:

```php
use Respect\Validation\Validator as v;
```

### Simple Validation

The Hello World validator is something like this:

```php
$number = 123;
v::numeric()->validate($number); //true
```

### Chained Validation

It is possible to use validators in a chain. Sample below validates a string
containing numbers and letters, no whitespace and length between 1 and 15.

```php
$usernameValidator = v::alnum()->noWhitespace()->length(1,15);
$usernameValidator->validate('alganet'); //true
```

### Validating Object Attributes

Given this simple object:

```php
$user = new stdClass;
$user->name = 'Alexandre';
$user->birthdate = '1987-07-01';
```

Is possible to validate its attributes in a single chain:

```php
$userValidator = v::attribute('name', v::string()->length(1,32))
                  ->attribute('birthdate', v::date()->minimumAge(18));

$userValidator->validate($user); //true
```

Validating array keys is also possible using `v::key()`

Note that we used `v::string()` and `v::date()` in the beginning of the validator.
Although is not mandatory, it is a good practice to use the type of the
validated object as the first node in the chain.

### Input optional

All validators treat input as optional and will accept empty string input as valid,
unless otherwise stated in the documentation.

We use the `v:notEmpty()` validator prefixed to disallow empty input and effectively
define the field as mandatory as input will be required or validation will fail.

```php
v::string()->notEmpty()->validate(''); //false input required
```

### Negating Rules

You can use the `v::not()` to negate any rule:

```php
v::not(v::int())->validate(10); //false, input must not be integer
```

### Validator Reuse

Once created, you can reuse your validator anywhere. Remember $usernameValidator?

```php
$usernameValidator->validate('respect');            //true
$usernameValidator->validate('alexandre gaigalas'); //false
$usernameValidator->validate('#$%');                //false
```

### Exception Types

* `Repect\Validation\Exceptions\ExceptionInterface`:
    * All exceptions implement this interface;
* `Respect\Validation\Exceptions\ValidationExceptionInterface`:
    * Extends the `Repect\Validation\Exceptions\ExceptionInterface` interface
    * Use when calling `check()`
    * All validation exceptions implement this interface
    * Interface has one method: `getMainMessage()`
* `Respect\Validation\Exceptions\NestedValidationExceptionInterface`:
    * Extends the `Respect\Validation\Exceptions\ValidationExceptionInterface` interface
    * Use when calling `assert()`
    * Interface has three methods: `getFullMessage()`, `findMessages()`, and `getMainMessage()`.

### Informative Exceptions

When something goes wrong, Validation can tell you exactly what's going on. For this,
we use the `assert()` method instead of `validate()`:

```php
use Respect\Validation\Exceptions\NestedValidationExceptionInterface

try {
    $usernameValidator->assert('really messed up screen#name');
} catch(NestedValidationExceptionInterface $exception) {
   echo $exception->getFullMessage();
}
```

The printed message is exactly this, as a text tree:

    \-All of the 3 required rules must pass
      |-"really messed up screen#name" must contain only letters (a-z) and digits (0-9)
      |-"really messed up screen#name" must not contain whitespace
      \-"really messed up screen#name" must have a length between 1 and 15

### Getting Messages

The text tree is fine, but unusable on a HTML form or something more custom. You can use
`findMessages()` for that:

```php
use Respect\Validation\Exceptions\NestedValidationExceptionInterface

try {
    $usernameValidator->assert('really messed up screen#name');
} catch(NestedValidationExceptionInterface $exception) {
    var_dump($exception->findMessages(array('alnum', 'length', 'noWhitespace')));
}
```

`findMessages()` returns an array with messages from the requested validators.

### Custom Messages

Getting messages as an array is fine, but sometimes you need to customize them in order
to present them to the user. This is possible using the `findMessages()` method as well:

```php
$errors = $exception->findMessages(array(
    'alnum'        => '{{name}} must contain only letters and digits',
    'length'       => '{{name}} must not have more than 15 chars',
    'noWhitespace' => '{{name}} cannot contain spaces'
));
```

For all messages, the `{{name}}` and `{{input}}` variable is available for templates.

### Custom Rules

You also can use your own rules:

```php
v::with('My\\Validation\\Rules\\');
v::myRule(); // Try to load "My\Validation\Rules\MyRule" if any
```

By default `with()` appends the given prefix, but you can change this behavior
in order to overwrite default rules:

```php
v::with('My\\Validation\\Rules\\', true);
v::alnum(); // Try to use "My\Validation\Rules\Alnum" if any
```

### Validator Name

On `v::attribute()` and `v::key()`, `{{name}}` is the attribute/key name. For others,
is the same as the input. You can customize a validator name using:

```php
v::date('Y-m-d')->between('1980-02-02', 'now')->setName('Member Since');
```

### Zend/Symfony Validators

It is also possible to reuse validators from other frameworks if they are installed:

```php
$hostnameValidator = v::zend('Hostname')->assert('google.com');
$timeValidator     = v::sf('Time')->assert('22:00:01');
```

### Validation Methods

We've seen `validate()` that returns true or false and `assert()` that throws a complete
validation report. There is also a `check()` method that returns an Exception
only with the first error found:

```php
use Respect\Validation\Exceptions\ValidationExceptionInterface

try {
    $usernameValidator->check('really messed up screen#name');
} catch(ValidationExceptionInterface $exception) {
    echo $exception->getMainMessage();
}
```

Message:

    "really messed up screen#name" must contain only letters (a-z) and digits (0-9)

## Reference

### Types

  * [arr](#arr)
  * [bool](#bool)
  * [date](#date)
  * [false](#false)
  * [float](#float)
  * [instance](#instance)
  * [int](#int)
  * [nullValue](#nullvalue)
  * [numeric](#numeric)
  * [object](#object)
  * [string](#string)
  * [true](#true)
  * [type](#type)
  * [xdigit](#xdigit)

### Generics

  * [alwaysInvalid](#alwaysinvalid)
  * [alwaysValid](#alwaysvalid)
  * [call](#call)
  * [callback](#callback)
  * [filterVar](#filtervar)
  * [not](#not)
  * [type](#type)
  * [when](#when)

### Comparing Values

  * [between](#between)
  * [equals](#equals)
  * [max](#max)
  * [min](#min)

### Numeric

  * [between](#between)
  * [bool](#bool)
  * [even](#even)
  * [float](#float)
  * [int](#int)
  * [multiple](#multiple)
  * [negative](#negative)
  * [notEmpty](#notempty)
  * [numeric](#numeric)
  * [odd](#odd)
  * [perfectSquare](#perfectsquare)
  * [positive](#positive)
  * [primeNumber](#primenumber)
  * [roman](#roman)
  * [xdigit](#xdigit)

### String

  * [alnum](#alnum)
  * [alpha](#alpha)
  * [between](#between)
  * [charset](#charset)
  * [cntrl](#cntrl)
  * [consonant](#consonant)
  * [contains](#contains)
  * [digit](#digit)
  * [endsWith](#endswith)
  * [graph](#graph)
  * [in](#in)
  * [length](#length)
  * [lowercase](#lowercase)
  * [notEmpty](#notempty)
  * [noWhitespace](#nowhitespace)
  * [prnt](#prnt)
  * [punct](#punct)
  * [regex](#regex)
  * [slug](#slug)
  * [space](#space)
  * [startsWith](#startswith)
  * [uppercase](#uppercase)
  * [version](#version)
  * [vowel](#vowel)
  * [xdigit](#xdigit)

### Arrays

  * [arr](#arr)
  * [contains](#contains)
  * [each](#each)
  * [endsWith](#endswith)
  * [in](#in)
  * [key](#key)
  * [length](#length)
  * [notEmpty](#notempty)
  * [startsWith](#startswith)

### Objects

  * [attribute](#attribute)
  * [instance](#instance)
  * [length](#length)

### Date and Time

  * [between](#between)
  * [date](#date)
  * [leapDate](#leapdate)
  * [leapYear](#leapyear)
  * [minimumAge](#minimumage)

### Group Validators

  * [allOf](#allof)
  * [noneOf](#noneof)
  * [oneOf](#oneof)

### Regional

  * [countryCode](#countrycode)
  * [postalCode](#postalcode)
  * [tld](#tld)

### Files

  * [directory](#directory)
  * [executable](#executable)
  * [exists](#exists)
  * [file](#file)
  * [readable](#readable)
  * [symbolicLink](#symboliclink)
  * [uploaded](#uploaded)
  * [writable](#writable)

### Banking

  * [bank](#bank)
  * [bankAccount](#bankaccount)
  * [bic](#bic)

### Other

  * [cnh](#cnh)
  * [cnpj](#cnpj)
  * [cpf](#cpf)
  * [domain](#domain)
  * [email](#email)
  * [hexRgbColor](#hexrgbcolor)
  * [ip](#ip)
  * [json](#json)
  * [macAddress](#macaddress)
  * [nfeAccessKey](#nfeaccesskey)
  * [phone](#phone)
  * [sf](#sf)
  * [url](#url)
  * [zend](#zend)

### Yes/No

  * [no](#no)
  * [yes](#yes)

### Alphabetically

#### allOf

- `v::allOf(v $v1, v $v2, v $v3...)`

Will validate if all inner validators validates.

```php
v::allOf(
    v::int(),
    v::positive()
)->validate(15); //true
```

This is similar to the chain (which is an allOf already), but
its syntax allows you to set custom names for every node:

```php
v::allOf(
    v::int()->setName('Account Number'),
    v::positive()->setName('Higher Than Zero')
)->setName('Positive integer')
 ->validate(15); //true
```

See also:

  * [oneOf](#oneof)
  * [noneOf](#noneof)
  * [when](#when)

#### alnum

- `v::alnum()`
- `v::alnum(string $additionalChars)`

Validates alphanumeric characters from a-Z and 0-9.

```php
v::alnum()->validate('foo 123'); //true
```

A parameter for extra characters can be used:

```php
v::alnum('-')->validate('foo - 123'); //true
```

This validator allows whitespace, if you want to
remove them add `->noWhitespace()` to the chain:

```php
v::alnum()->noWhitespace->validate('foo 123'); //false
```

By default empty values are allowed, if you want
to invalidate them, add `->notEmpty()` to the chain:

```php
v::alnum()->notEmpty()->validate(''); //false
```

You can restrict case using the `->lowercase()` and
`->uppercase()` validators:

```php
v::alnum()->uppercase()->validate('aaa'); //false
```

Message template for this validator includes `{{additionalChars}}` as
the string of extra chars passed as the parameter.

See also:

  * [alpha](#alpha)
  * [digit](#digit)
  * [consonant](#consonant)
  * [vowel](#vowel)

#### alpha

- `v::alpha()`
- `v::alpha(string $additionalChars)`

This is similar to v::alnum(), but it doesn't allow numbers. It also
accepts empty values and whitespace, so use `v::notEmpty()` and
`v::noWhitespace()` when appropriate.

See also:

  * [alnum](#alnum)
  * [digit](#digit)
  * [consonant](#consonant)
  * [vowel](#vowel)

#### alwaysInvalid

- `v::alwaysInvalid()`

Always return false.

```php
v::alwaysInvalid()->validate($whatever); //false
```

See also:

  * [alwaysValid](#alwaysvalid)

#### alwaysValid

- `v::alwaysValid()`

Always returns true.

```php
v::alwaysValid()->validate($whatever); //true
```

See also:

  * [alwaysInvalid](#alwaysinvalid)

#### arr

- `v::arr()`

Validates if the input is an array or traversable object.

```php
v::arr()->validate(array()); //true
v::arr()->validate(new ArrayObject); //true
```

See also:

  * [each](#each)
  * [key](#key)

#### attribute

- `v::attribute(string $name)`
- `v::attribute(string $name, v $validator)`
- `v::attribute(string $name, v $validator, boolean $mandatory = true)`

Validates an object attribute.

```php
$obj = new stdClass;
$obj->foo = 'bar';

v::attribute('foo')->validate($obj); //true
```

You can also validate the attribute itself:

```php
v::attribute('foo', v::equals('bar'))->validate($obj); //true
```

Third parameter makes the attribute presence optional:

```php
v::attribute('lorem', v::string(), false)->validate($obj); // true
```

The name of this validator is automatically set to the attribute name.

See also:

  * [key](#key)

#### bank

- `v::bank(string $countryCode)`

Validates a bank.

```php
v::bank("de")->validate("70169464"); //true
v::bank("de")->validate("12345"); //false
```

These country codes are supported:

 * "de" (Germany) - You must add `"malkusch/bav": "~1.0"` to your `require` property on composer.json file.

See also

  * [bankAccount](#bankaccount)
  * [bic](#bic)

#### bankAccount

- `v::bankAccount(string $countryCode, string $bank)`

Validates a bank account for a given bank.

```php
v::bankAccount("de", "70169464")->validate("1112"); //true
v::bankAccount("de", "70169464")->validate("1234"); //false
```

These country codes are supported:

 * "de" (Germany) - You must add `"malkusch/bav": "~1.0"` to your `require` property on composer.json file.

See also

  * [bank](#bank)
  * [bic](#bic)

#### between

- `v::between(mixed $start, mixed $end)`
- `v::between(mixed $start, mixed $end, boolean $inclusive = false)`

Validates ranges. Most simple example:

```php
v::int()->between(10, 20)->validate(15); //true
```

The type as the first validator in a chain is a good practice,
since between accepts many types:

```php
v::string()->between('a', 'f')->validate('c'); //true
```

Also very powerful with dates:

```php
v::date()->between('2009-01-01', '2013-01-01')->validate('2010-01-01'); //true
```

Date ranges accept strtotime values:

```php
v::date()->between('yesterday', 'tomorrow')->validate('now'); //true
```

A third parameter may be passed to validate the passed values inclusive:

```php
v::date()->between(10, 20, true)->validate(20); //true
```

Message template for this validator includes `{{minValue}}` and `{{maxValue}}`.

See also:

  * [length](#length)
  * [min](#min)
  * [max](#max)

#### bic

- `v::bic(string $countryCode)`

Validates a BIC (Bank Identifier Code) for a given country.

```php
v::bic("de")->validate("VZVDDED1XXX"); //true
v::bic("de")->validate("VZVDDED1"); //true
```

Theses country codes are supported:

 * "de" (Germany) - You must add `"malkusch/bav": "~1.0"` to your `require` property on composer.json file.

See also

  * [bank](#bank)
  * [bankAccount](#bankaccount)

#### bool

- `v::bool()`

Validates if the input is a boolean value:

```php
v::bool()->validate(true); //true
v::bool()->validate(false); //true
```

#### call

- `v::call(callable $callback)`

This is a very low level validator. It calls a function, method or closure
for the input and then validates it. Consider the following variable:

```php
$url = 'http://www.google.com/search?q=respect.github.com'
```

To validate every part of this URL we could use the native `parse_url`
function to break its parts:

```php
$parts = parse_url($url);
```

This function returns an array containing `scheme`, `host`, `path` and `query`.
We can validate them this way:

```php
v::arr()->key('scheme', v::startsWith('http'))
        ->key('host',   v::domain())
        ->key('path',   v::string())
        ->key('query',  v::notEmpty());
```

Using `v::call()` you can do this in a single chain:

```php
v::call(
    'parse_url',
     v::arr()->key('scheme', v::startsWith('http'))
        ->key('host',   v::domain())
        ->key('path',   v::string())
        ->key('query',  v::notEmpty())
)->validate($url);
```

It is possible to call methods and closures as the first parameter:

```php
v::call(array($myObj, 'methodName'), v::int())->validate($myInput);
v::call(function($input) {}, v::int())->validate($myInput);
```

See also:

  * [callback](#callback)

#### callback

- `v::callback(callable $callback)`

This is a wildcard validator, it uses a function name, method or closure
to validate something:

```php
v::callback('is_int')->validate(10); //true
```

(Please note that this is a sample, the `v::int()` validator is much better).

As in `v::call()`, you can pass a method or closure to it.

See also:

  * [call](#call)
  * [filterVar](#filtervar)

#### charset

- `v::charset(mixed $charset)`

Validates if a string is in a specific charset.

```php
v::charset('ASCII')->validate('açúcar'); //false
v::charset('ASCII')->validate('sugar');  //true
v::charset(array('ISO-8859-1', 'EUC-JP'))->validate('日本国'); // true
```

The array format is a logic OR, not AND.

#### cnh

- `v::cnh()`

Validates a Brazillian driver's license.

```php
v::cnh()->validate('02650306461'); //true
```

See also:

  * [cnpj](#cnpj)
  * [cpf](#cpf)

#### cnpj

- `v::cnpj()`

Validates the Brazillian CNPJ number. Ignores non-digit chars, so
use `->digit()` if needed.

See also:

  * [cpf](#cpf)
  * [cnh](#cnh)

#### cntrl

- `v::cntrl()`
- `v::cntrl(string $additionalChars)`

This is similar to `v::alnum()`, but only accepts control characters:

```php
v::cntrl()->validate("\n\r\t"); //true
```

See also:

  * [alnum](#alnum)
  * [prnt](#prnt)
  * [space](#space)

#### consonant

- `v::consonant()`
- `v::consonant(string $additionalChars)`

Similar to `v::alnum()`. Validates strings that contain only consonants:

```php
v::consonant()->validate('xkcd'); //true
```

See also:

  * [alnum](#alnum)
  * [digit](#digit)
  * [alpha](#alpha)
  * [vowel](#vowel)

#### contains

- `v::contains(mixed $value)`
- `v::contains(mixed $value, boolean $identical = false)`

For strings:

```php
v::contains('ipsum')->validate('lorem ipsum'); //true
```

For arrays:

```php
v::contains('ipsum')->validate(array('ipsum', 'lorem')); //true
```

A second parameter may be passed for identical comparison instead
of equal comparison.

Message template for this validator includes `{{containsValue}}`.

See also:

  * [startsWith](#startswith)
  * [endsWith](#endswith)
  * [in](#in)

#### countryCode

- `v::countryCode()`

Validates an ISO country code like US or BR.

```php
v::countryCode()->validate('BR'); //true
```

See also:

  * [tld](#tld)

#### cpf

- `v::cpf()`

Validates a Brazillian CPF number.

```php
v::cpf()->validate('44455566820'); //true
```

It ignores any non-digit char:

```php
v::cpf()->validate('444.555.668-20'); //true
```

If you need to validate digits only, add `->digit()` to
the chain:

```php
v::digit()->cpf()->validate('44455566820'); //true
```

See also:

  * [cnpj](#cnpj)
  * [cnh](#cnh)

#### creditCard

- `v::creditCard()`

Validates a credit card number.

```php
v::creditCard()->validate('5376 7473 9720 8720'); //true
```

It ignores any non-digit chars, so use `->digit()` when appropriate.

```php
v::digit()->creditCard()->validate('5376747397208720'); //true
```

#### date

- `v::date()`
- `v::date(string $format)`

Validates if input is a date:

```php
v::date()->validate('2009-01-01'); //true
```

Also accepts strtotime values:

```php
v::date()->validate('now'); //true
```

And DateTime instances:

```php
v::date()->validate(new DateTime); //true
```

You can pass a format when validating strings:

```php
v::date('Y-m-d')->validate('01-01-2009'); //false
```

Format has no effect when validating DateTime instances.

Message template for this validator includes `{{format}}`.

See also:

  * [between](#between)
  * [minimumAge](#minimumage)
  * [leapDate](#leapdate)
  * [leapYear](#leapyear)

#### digit

- `v::digit()`

This is similar to v::alnum(), but it doesn't allow a-Z. It also
accepts empty values and whitespace, so use `v::notEmpty()` and
`v::noWhitespace()` when appropriate.

See also:

  * [alnum](#alnum)
  * [alpha](#alpha)
  * [vowel](#vowel)
  * [consonant](#consonant)

#### directory

- `v::directory()`

Validates directories.

```php
v::directory()->validate(__DIR__); //true
v::directory()->validate(__FILE__); //false
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::directory()->validate(new \SplFileInfo($directory));
```

See also

  * [exists](#exists)
  * [file](#file)

#### domain

- `v::domain()`
- `v::domain(boolean $tldCheck = true)`

Validates domain names.

```php
v::domain()->validate('google.com');
```

You can skip *top level domain* (TLD) checks to validate internal
domain names:

```php
v::domain(false)->validate('dev.machine.local');
```

This is a composite validator, it validates several rules
internally:

  * If input is an IP address, it fails.
  * If input contains whitespace, it fails.
  * If input does not contain any dots, it fails.
  * If input has less than two parts, it fails.
  * Input must end with a top-level-domain to pass (if not skipped).
  * Each part must be alphanumeric and not start with an hyphen.
  * [PunnyCode][] is accepted for [Internationalizing Domain Names in Applications][IDNA].

Messages for this validator will reflect rules above.

See also:

  * [tld](#tld)
  * [ip](#ip)

[PunnyCode]: http://en.wikipedia.org/wiki/Punycode "Wikipedia: Punnycode"
[IDNA]: http://en.wikipedia.org/wiki/Internationalized_domain_name#Internationalizing_Domain_Names_in_Applications "Wikipedia: Internationalized domain name"

#### each

- `v::each(v $validatorForValue)`
- `v::each(null, v $validatorForKey)`
- `v::each(v $validatorForValue, v $validatorForKey)`

Iterates over an array or Iterator and validates the value or key
of each entry:

```php
$releaseDates = array(
    'validation' => '2010-01-01',
    'template'   => '2011-01-01',
    'relational' => '2011-02-05',
);

v::arr()->each(v::date())->validate($releaseDates); //true
v::arr()->each(v::date(), v::string()->lowercase())->validate($releaseDates); //true
```

Using `arr()` before `each()` is a best practice.

See also:

  * [key](#key)
  * [arr](#arr)

#### email

- `v::email()`

Validates an email address.

```php
v::email()->validate('alexandre@gaigalas.net'); //true
```

#### endsWith

- `v::endsWith(mixed $value)`
- `v::endsWith(mixed $value, boolean $identical = false)`

This validator is similar to `v::contains()`, but validates
only if the value is at the end of the input.

For strings:

```php
v::endsWith('ipsum')->validate('lorem ipsum'); //true
```

For arrays:

```php
v::endsWith('ipsum')->validate(array('lorem', 'ipsum')); //true
```

A second parameter may be passed for identical comparison instead
of equal comparison.

Message template for this validator includes `{{endValue}}`.

See also:

  * [startsWith](#startswith)
  * [contains](#contains)
  * [in](#in)

#### equals

- `v::equals(mixed $value)`
- `v::equals(mixed $value, boolean $identical = false)`

Validates if the input is equal some value.

```php
v::equals('alganet')->validate('alganet'); //true
```

Identical validation (===) is possible:

```php
v::equals(10)->validate('10'); //true
v::equals(10, true)->validate('10'); //false
```

Message template for this validator includes `{{compareTo}}`.

See also:

  * [contains](#contains)

#### even

- `v::even()`

Validates an even number.

```php
v::int()->even()->validate(2); //true
```

Using `int()` before `even()` is a best practice.

See also

  * [odd](#odd)
  * [multiple](#multiple)

#### executable

- `v::executable()`

Validates if a file is an executable.

```php
v::email()->executable('script.sh'); //true
```

See also

  * [readable](#readable)
  * [writable](#writable)

#### exists

- `v::exists()`

Validates files or directories.

```php
v::exists()->validate(__FILE__); //true
v::exists()->validate(__DIR__); //true
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::exists()->validate(new \SplFileInfo($file));
```

See also

  * [directory](#directory)
  * [file](#file)

#### false

- `v::false()`

Validates if a value is considered as `false`.

```php
v::false()->validate(false); //true
v::false()->validate(0); //true
v::false()->validate('0'); //true
v::false()->validate('false'); //true
v::false()->validate('off'); //true
v::false()->validate('no'); //true
```

See also

  * [true](#true)

#### file

- `v::file()`

Validates files.

```php
v::file()->validate(__FILE__); //true
v::file()->validate(__DIR__); //false
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::file()->validate(new \SplFileInfo($file));
```

See also

  * [directory](#directory)
  * [exists](#exists)

#### filterVar

- `v::filterVar(int $filter)`
- `v::filterVar(int $filter, mixed $options)`

A wrapper for PHP's [filter_var()](http://php.net/filter_var) function.

```php
v::filterVar(FILTER_VALIDATE_EMAIL)->validate('bob@example.com'); //true
v::filterVar(FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)->validate('http://example.com'); //true
```

See also

  * [callback](#callback)

#### float

- `v::float()`

Validates a floating point number.

```php
v::float()->validate(1.5); //true
v::float()->validate('1e5'); //true
```

#### graph

- `v::graph()`
- `v::graph(string $additionalChars)`

Validates all characters that are graphically represented.

```php
v::graph()->validate('LKM@#$%4;'); //true
```

See also:

  * [prnt](#prnt)

#### hexRgbColor

- `v::hexRgbColor()`

Validates a hex RGB color

```php
v::hexRgbColor()->validate('#FFFAAA'); //true
v::hexRgbColor()->validate('123123'); //true
v::hexRgbColor()->validate('FCD'); //true
```

See also:

  * [vxdigit](#vxdigit)

#### in

- `v::in(mixed $haystack)`
- `v::in(mixed $haystack, boolean $identical = false)`

Validates if the input is contained in a specific haystack.

For strings:

```php
v::in('lorem ipsum')->validate('ipsum'); //true
```

For arrays:

```php
v::in(array('lorem', 'ipsum'))->validate('lorem'); //true
```

A second parameter may be passed for identical comparison instead
of equal comparison.

Message template for this validator includes `{{haystack}}`.

See also:

  * [startsWith](#startswith)
  * [endsWith](#endswith)
  * [contains](#contains)

#### instance

- `v::instance(string $instanceName)`

Validates if the input is an instance of the given class or interface.

```php
v::instance('DateTime')->validate(new DateTime); //true
v::instance('Traversable')->validate(new ArrayObject); //true
```

Message template for this validator includes `{{instanceName}}`.

See also:

  * [object](#object)

#### int

- `v::int()`

Validates if the input is an integer.

```php
v::int()->validate('10'); //true
v::int()->validate(10); //true
```

See also:

  * [numeric](#numeric)
  * [digit](#digit)

#### ip

- `v::ip()`
- `v::ip(mixed $options)`

Validates IP Addresses. This validator uses the native filter_var()
PHP function.

```php
v::ip()->validate('192.168.0.1');
```

You can pass a parameter with filter_var flags for IP.

```php
v::ip(FILTER_FLAG_NO_PRIV_RANGE)->validate('127.0.0.1'); //false
```

#### json

- `v::json()`

Validates if the given input is a valid JSON.

```php
v::json()->validate('{"foo":"bar"}'); //true
```

#### key

- `v::key(string $name)`
- `v::key(string $name, v $validator)`
- `v::key(string $name, v $validator, boolean $mandatory = true)`

Validates an array key.

```php
$dict = array(
    'foo' => 'bar'
);

v::key('foo')->validate($dict); //true
```

You can also validate the key value itself:

```php
v::key('foo', v::equals('bar'))->validate($dict); //true
```

Third parameter makes the key presence optional:

```php
v::key('lorem', v::string(), false)->validate($dict); // true
```

The name of this validator is automatically set to the key name.

See also:

  * [attribute](#attribute)

#### leapDate

- `v::leapDate(string $format)`

Validates if a date is leap.

```php
v::leapDate('Y-m-d')->validate('1988-02-29'); //true
```

This validator accepts DateTime instances as well. The $format
parameter is mandatory.

See also:

  * [date](#date)
  * [leapYear](#leapyear)

#### leapYear

- `v::leapYear()`

Validates if a year is leap.

```php
v::leapYear()->validate('1988'); //true
```

This validator accepts DateTime instances as well.

See also:

  * [date](#date)
  * [leapDate](#leapdate)

#### length

- `v::length(int $min, int $max)`
- `v::length(int $min, null)`
- `v::length(null, int $max)`
- `v::length(int $min, int $max, boolean $inclusive = true)`

Validates lengths. Most simple example:

```php
v::string()->length(1, 5)->validate('abc'); //true
```

You can also validate only minimum length:

```php
v::string()->length(5, null)->validate('abcdef'); // true
```

Only maximum length:

```php
v::string()->length(null, 5)->validate('abc'); // true
```

The type as the first validator in a chain is a good practice,
since length accepts many types:

```php
v::arr()->length(1, 5)->validate(array('foo', 'bar')); //true
```

A third parameter may be passed to validate the passed values inclusive:

```php
v::string()->length(1, 5, true)->validate('a'); //true
```

Message template for this validator includes `{{minValue}}` and `{{maxValue}}`.

See also:

  * [between](#between)

#### lowercase

- `v::lowercase()`

Validates if string characters are lowercase in the input:

```php
v::string()->lowercase()->validate('xkcd'); //true
```

See also:

  * [uppercase](#uppercase)

#### macAddress

- `v::macAddress()`

Validates a Mac Address.

```php
v::macAddress()->validate('00:11:22:33:44:55'); //true
v::macAddress()->validate('af-AA-22-33-44-55'); //true
```

#### max

- `v::max(mixed $maxValue)`
- `v::max(mixed $maxValue, boolean $inclusive = false)`

Validates if the input doesn't exceed the maximum value.

```php
v::int()->max(15)->validate(20); //false
v::int()->max(20)->validate(20); //false
v::int()->max(20, true)->validate(20); //true
```

Also accepts dates:

```php
v::date()->max('2012-01-01')->validate('2010-01-01'); //true
```

Also date intervals:

```php
// Same of minimum age validation
v::date()->max('-18 years')->validate('1988-09-09'); //true
```

`true` may be passed as a parameter to indicate that inclusive
values must be used.

Message template for this validator includes `{{maxValue}}`.

See also:

  * [min](#min)
  * [between](#between)

#### min

- `v::min(mixed $minValue)`
- `v::min(mixed $minValue, boolean $inclusive = false)`

Validates if the input is greater than the minimum value.

```php
v::int()->min(15)->validate(5); //false
v::int()->min(5)->validate(5); //false
v::int()->min(5, true)->validate(5); //true
```

Also accepts dates:

```php
v::date()->min('2012-01-01')->validate('2015-01-01'); //true
```

`true` may be passed as a parameter to indicate that inclusive
values must be used.

Message template for this validator includes `{{minValue}}`.

See also:

  * [max](#max)
  * [between](#between)

#### minimumAge

- `v::minimumAge(int $age)`
- `v::minimumAge(int $age, string $format)`

Validates a minimum age for a given date.

```php
v::minimumAge(18)->validate('1987-01-01'); //true
v::minimumAge(18, 'd/m/Y')->validate('01/01/1987'); //true
```

Using `date()` before is a best-practice.

Message template for this validator includes `{{age}}`.

See also:

  * [date](#date)

#### multiple

- `v::multiple(int $multipleOf)`

Validates if the input is a multiple of the given parameter

```php
v::int()->multiple(3)->validate(9); //true
```

See also:

  * [primeNumber](#primenumber)

#### negative

- `v::negative()`

Validates if a number is lower than zero

```php
v::numeric()->negative()->validate(-15); //true
```

See also:

  * [positive](#positive)

#### nfeAccessKey

- `v::nfeAccessKey(string $accessKey)`

Validates the access key of the Brazilian electronic invoice (NFe).

```php
v::nfeAccessKey()->validate('31841136830118868211870485416765268625116906'); //true
```

#### no

- `v::no()`
- `v::no(boolean $locale)`

Validates if value is considered as "No".

```php
v::no()->validate('N'); //true
v::no()->validate('Nay'); //true
v::no()->validate('Nix'); //true
v::no()->validate('No'); //true
v::no()->validate('Nope'); //true
v::no()->validate('Not'); //true
```

This rule is case insensitive.

If `$locale` is TRUE, uses the value of [nl_langinfo()](http://php.net/nl_langinfo) with `NOEXPR` constant.

See also:

  * [yes](#yes)

#### noneOf

- `v::noneOf(v $v1, v $v2, v $v3...)`

Validates if NONE of the given validators validate:

```php
v::noneOf(
    v::int(),
    v::float()
)->validate('foo'); //true
```

In the sample above, 'foo' isn't a integer nor a float, so noneOf returns true.

See also:

  * [not](#not)
  * [allOf](#allof)
  * [oneOf](#oneof)

#### not

- `v::not(v $negatedValidator)`

Negates any rule.

```php
v::not(v::ip())->validate('foo'); //true
```

using a shortcut

```php
v::ip()->not()->validate('foo'); //true
```

In the sample above, validator returns true because 'foo' isn't an IP Address.

You can negate complex, grouped or chained validators as well:

```php
v::not(v::int()->positive())->validate(-1.5); //true
```

using a shortcut

```php
v::int()->positive()->not()->validate(-1.5); //true
```

Each other validation has custom messages for negated rules.

See also:

  * [noneOf](#noneof)

#### notEmpty

- `v::notEmpty()`

Validates if the given input is not empty or in other words is input mandatory and
required. This function also takes whitespace into account, use `noWhitespace()`
if no spaces or linebreaks and other whitespace anywhere in the input is desired.

```php
v::string()->notEmpty()->validate(''); //false
```

Null values are empty:

```php
v::notEmpty()->validate(null); //false
```

Numbers:

```php
v::int()->notEmpty()->validate(0); //false
```

Empty arrays:

```php
v::arr()->notEmpty()->validate(array()); //false
```

Whitespace:

```php
v::string()->notEmpty()->validate('        ');  //false
v::string()->notEmpty()->validate("\t \n \r");  //false
```

See also:

  * [noWhitespace](#nowhitespace)
  * [nullValue](#nullvalue)

#### noWhitespace

- `v::noWhitespace()`

Validates if a string contains no whitespace (spaces, tabs and line breaks);

```php
v::noWhitespace()->validate('foo bar');  //false
v::noWhitespace()->validate("foo\nbar"); //false
```

Like other rules the input is still optional.

```php
v::string()->noWhitespace()->validate('');  //true
v::string()->noWhitespace()->validate(' '); //false
```

This is most useful when chaining with other validators such as `v::alnum()`

#### nullValue

- `v::nullValue()`

Validates if the input is null. This rule does not allow empty strings to avoid ambiguity.

```php
v::nullValue()->validate(null); //true
```

See also:

  * [notEmpty](#notempty)

#### numeric

- `v::numeric()`

Validates on any numeric value.

```php
v::numeric()->validate(-12); //true
v::numeric()->validate('135.0'); //true
```

See also:

  * [int](#int)
  * [digit](#digit)

#### object

- `v::object()`

Validates if the input is an object.

```php
v::object()->validate(new stdClass); //true
```

See also:

  * [instance](#instance)
  * [attribute](#attribute)

#### odd

- `v::odd()`

Validates an odd number.

```php
v::int()->odd()->validate(3); //true
```

Using `int()` before `odd()` is a best practice.

See also

  * [even](#even)
  * [multiple](#multiple)

#### oneOf

- `v::oneOf(v $v1, v $v2, v $v3...)`

This is a group validator that acts as an OR operator.

```php
v::oneOf(
    v::int(),
    v::float()
)->validate(15.5); //true
```

In the sample above, `v::int()` doesn't validates, but
`v::float()` validates, so oneOf returns true.

`v::oneOf` returns true if at least one inner validator
passes.

Using a shortcut

```php
v::int()->addOr(v::float())->validate(15.5); //true
```

See also:

  * [allOf](#allof)
  * [noneOf](#noneof)
  * [when](#when)

#### perfectSquare

- `v::perfectSquare()`

Validates a perfect square.

```php
v::perfectSquare()->validate(25); //true (5*5)
v::perfectSquare()->validate(9); //true (3*3)
```

#### phone

- `v::phone()`

Validates a valid 7, 10, 11 digit phone number (North America, Europe and most
Asian and Middle East countries), supporting country and area codes (in dot,
space or dashed notations) such as:

    (555)555-5555
    555 555 5555
    +5(555)555.5555
    33(1)22 22 22 22
    +33(1)22 22 22 22
    +33(020)7777 7777
    03-6106666

#### positive

- `v::positive()`

Validates if a number is higher than zero

```php
v::numeric()->positive()->validate(-15); //false
```

See also:

  * [negative](#negative)

#### postalCode

- `v::postalCode(string $countryCode)`

Validates a postal code according to the given country code.

```php
v::numeric()->postalCode('BR')->validate('02179000'); //true
v::numeric()->postalCode('BR')->validate('02179-000'); //true
v::numeric()->postalCode('US')->validate('02179-000'); //false
```

Extracted from [GeoNames](http://www.geonames.org/).

See also:

  * [countryCode](#countrycode)

#### primeNumber

- `v::primeNumber()`

Validates a prime number

```php
v::primeNumber()->validate(7); //true
```

#### prnt

- `v::prnt()`
- `v::prnt(string $additionalChars)`

Similar to `v::graph` but accepts whitespace.

```php
v::prnt()->validate('LMKA0$% _123'); //true
```

See also:

  * [graph](#graph)

#### punct

- `v::punct()`
- `v::punct(string $additionalChars)`

Accepts only punctuation characters:

```php
v::punct()->validate('&,.;[]'); //true
```

See also:

  * [cntrl](#cntrl)
  * [graph](#graph)
  * [prnt](#prnt)

#### readable

- `v::readable()`

Validates if the given data is a file exists and is readable.

```php
v::readable()->validate('/path/of/a/readable/file'); //true
```

#### regex

- `v::regex(string $regex)`

Evaluates a regex on the input and validates if matches

```php
v::regex('/[a-z]/')->validate('a'); //true
```

Message template for this validator includes `{{regex}}`

#### roman

- `v::roman()`

Validates roman numbers

```php
v::roman()->validate('IV'); //true
```

This validator ignores empty values, use `notEmpty()` when
appropriate.

#### sf

- `v::sf(string $validator)`

Use Symfony2 validators inside Respect\Validation flow. Messages
are preserved.

```php
v::sf('Time')->validate('15:00:00');
```


You must add `"symfony/validator": "~2.6"` to your `require` property on composer.json file.


See also:

  * [zend](#zend)

#### slug

- `v::slug()`

Validates slug-like strings:

```php
v::slug()->validate('my-wordpress-title'); //true
v::slug()->validate('my-wordpress--title'); //false
v::slug()->validate('my-wordpress-title-'); //false
```

#### space

- `v::space()`
- `v::space(string $additionalChars)`

Accepts only whitespace:

```php
v::space()->validate('    '); //true
```

See also:

  * [cntrl](#cntrl)

#### startsWith

- `v::startsWith(mixed $value)`
- `v::startsWith(mixed $value, boolean $identical = false)`

This validator is similar to `v::contains()`, but validates
only if the value is at the beginning of the input.

For strings:

```php
v::startsWith('lorem')->validate('lorem ipsum'); //true
```

For arrays:

```php
v::startsWith('lorem')->validate(array('lorem', 'ipsum')); //true
```

`true` may be passed as a parameter to indicate identical comparison
instead of equal.

Message template for this validator includes `{{startValue}}`.

See also:

  * [endsWith](#endswith)
  * [contains](#contains)
  * [in](#in)

#### string

- `v::string()`

Validates a string.

```php
v::string()->validate('hi'); //true
```

See also:

  * [alnum](#alnum)

#### symbolicLink

- `v::symbolicLink()`

Validates if the given data is a path of a valid symbolic link.

```php
v::symbolicLink()->validate('/path/of/valid/symbolic/link'); //true
```

#### tld

- `v::tld()`

Validates a top-level domain

```php
v::tld()->validate('com'); //true
v::tld()->validate('ly'); //true
v::tld()->validate('org'); //true
```

See also

 * [domain](#domain)
 * [countryCode](#countrycode)

#### true

- `v::true()`

Validates if a value is considered as `true`.

```php
v::true()->validate(true); //true
v::true()->validate(1); //true
v::true()->validate('1'); //true
v::true()->validate('true'); //true
v::true()->validate('on'); //true
v::true()->validate('yes'); //true
```

See also

  * [false](#false)

#### type

- `v::type(string $type)`

Validates the type of input.

```php
v::type('bool')->validate(true); //true
v::type('callable')->validate(function (){}); //true
v::type('object')->validate(new stdClass()); //true
```

See also

  * [arr](#arr)
  * [bool](#bool)
  * [float](#float)
  * [instance](#instance)
  * [int](#int)
  * [object](#object)
  * [string](#string)

#### uploaded

- `v::uploaded()`

Validates if the given data is a file that was uploaded via HTTP POST.

```php
v::uploaded()->validate('/path/of/an/uploaded/file'); //true
```

#### uppercase

- `v::uppercase()`

Validates if string characters are uppercase in the input:

```php
v::string()->uppercase()->validate('W3C'); //true
```

See also:

  * [lowercase](#lowercase)

#### url

- `v::url()`

Validates if input is an URL:

```php
v::url()->validate('http://example.com'); //true
v::url()->validate('https://www.youtube.com/watch?v=6FOUqQt3Kg0'); //true
v::url()->validate('ldap://[::1]'); //true
v::url()->validate('mailto:john.doe@example.com'); //true
v::url()->validate('news:new.example.com'); //true
```

This rule uses [filterVar](#filtervar)

See also:

  * [domain](#domain)
  * [filterVar](#filtervar)

#### version

- `v::version()`

Validates version numbers using Semantic Versioning.

```php
v::version()->validate('1.0.0');
```

#### vowel

- `v::vowel()`

Similar to `v::alnum()`. Validates strings that contains only vowels:

```php
v::vowel()->validate('aei'); //true
```

See also:

  * [alnum](#alnum)
  * [digit](#digit)
  * [alpha](#alpha)
  * [consonant](#consonant)

#### when

- `v::when(v $if, v $then, v $else)`
- `v::when(v $if, v $then)`

A ternary validator that accepts three parameters.

When the `$if` validates, returns validation for `$then`.
When the `$if` doesn't validate, returns validation for `$else`, if defined.

```php
v::when(v::int(), v::positive(), v::notEmpty())->validate($input);
```

In the sample above, if `$input` is an integer, then it must be positive.
If `$input` is not an integer, then it must not me empty.
When `$else` is not defined use [alwaysInvalid](#alwaysinvalid)

See also:

  * [allOf](#allof)
  * [oneOf](#oneof)
  * [noneOf](#noneof)

#### writable

- `v::writable()`

Validates if the given input is writable file.

```php
v::writable()->validate('/path/of/a/writable/file'); //true
```

#### xdigit

- `v::xdigit()`

Accepts an hexadecimal number:

```php
v::xdigit()->validate('abc123'); //true
```

Notice, however, that it doesn't accept strings starting with 0x:

```php
v::xdigit()->validate('0x1f'); //false
```

See also:

  * [digit](#digit)
  * [alnum](#alnum)
  * [hexRgbColor](#hexrgbcolor)

#### yes

- `v::yes()`
- `v::yes(boolean $locale)`

Validates if value is considered as "Yes".

```php
v::yes()->validate('Y');//true
v::yes()->validate('Yea');//true
v::yes()->validate('Yeah');//true
v::yes()->validate('Yep');//true
v::yes()->validate('Yes');//true
```

This rule is case insensitive.

If `$locale` is TRUE, uses the value of [nl_langinfo()](http://php.net/nl_langinfo) with `YESEXPR` constant.

See also:

  * [no](#no)

#### zend

- `v::zend(mixed $validator)`

Use Zend validators inside Respect\Validation flow. Messages
are preserved.

```php
v::zend('Hostname')->validate('google.com');
```

You must add `"zendframework/zend-validator": "~2.3"` to your `require` property on composer.json file.

See also:

  * [sf](#sf)
