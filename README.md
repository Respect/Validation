Respect\Validation
==================

[![Build Status](https://img.shields.io/travis/Respect/Validation.svg?style=flat-square)](http://travis-ci.org/Respect/Validation)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/Respect/Validation.svg?style=flat-square)](https://scrutinizer-ci.com/g/Respect/Validation/?branch=master)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/Respect/Validation.svg?style=flat-square)](https://scrutinizer-ci.com/g/Respect/Validation/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/respect/validation.svg?style=flat-square&label=stable)](https://packagist.org/packages/respect/validation)
[![Total Downloads](https://img.shields.io/packagist/dt/respect/validation.svg?style=flat-square)](https://packagist.org/packages/respect/validation)
[![License](https://img.shields.io/packagist/l/respect/validation.svg?style=flat-square)](https://packagist.org/packages/respect/validation)

[The most awesome validation engine ever created for PHP.](http://bit.ly/1a1oeQv)

- Complex (custom) rules made simple: `v::numeric()->positive()->between(1, 256)->validate($myNumber)`.
- Awesome (customizable, iterable) exceptions.
- >80 (fully tested) validators.

Installation
------------

The package is available on [Packagist](http://packagist.org/packages/respect/validation).
Autoloading is [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) compatible.

```shell
composer require respect/validation
```

Feature Guide
-------------

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

### Informative Exceptions

When something goes wrong, Validation can tell you exactly what's going on. For this,
we use the `assert()` method instead of `validate()`:

```php
try {
    $usernameValidator->assert('really messed up screen#name');
} catch(DomainException $e) {
   echo $e->getFullMessage();
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
try {
    $usernameValidator->assert('really messed up screen#name');
} catch(\InvalidArgumentException $e) {
    var_dump($e->findMessages(array('alnum', 'length', 'noWhitespace')));
}
```

`findMessages()` returns an array with messages from the requested validators.

### Custom Messages

Getting messages as an array is fine, but sometimes you need to customize them in order
to present them to the user. This is possible using the `findMessages()` method as well:

```php
$errors = $e->findMessages(array(
    'alnum'        => '{{name}} must contain only letters and digits',
    'length'       => '{{name}} must not have more than 15 chars',
    'noWhitespace' => '{{name}} cannot contain spaces'
));
```

For all messages, the `{{name}}` and `{{input}}` variable is available for templates.

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
try {
    $usernameValidator->check('really messed up screen#name');
} catch(\InvalidArgumentException $e) {
    echo $e->getMainMessage();
}
```

Message:

    "really messed up screen#name" must contain only letters (a-z) and digits (0-9)

Reference
---------

### Types

  * [v::arr()](#varr)
  * [v::bool()](#vbool)
  * [v::date()](#vdate)
  * [v::float()](#vfloat)
  * [v::hexa()](#vhexa-deprecated) *(deprecated)*
  * [v::instance()](#vinstanceinstancename)
  * [v::int()](#vint)
  * [v::nullValue()](#vnullvalue)
  * [v::numeric()](#vnumeric)
  * [v::object()](#vobject)
  * [v::string()](#vstring)
  * [v::xdigit()](#vxdigit)

### Generics

  * [v::call()](#vcallcallable-callback)
  * [v::callback()](#vcallbackcallable-callback)
  * [v::not()](#vnotv-negatedvalidator)
  * [v::when()](#vwhenv-if-v-then-v-else)
  * [v::alwaysValid()](#valwaysvalid)
  * [v::alwaysInvalid()](#valwaysinvalid)

### Comparing Values

  * [v::between()](#vbetweenstart-end)
  * [v::equals()](#vequalsvalue)
  * [v::max()](#vmaxmax)
  * [v::min()](#vminmin)

### Numeric

  * [v::between()](#vbetweenstart-end)
  * [v::bool()](#vbool)
  * [v::even()](#veven)
  * [v::float()](#vfloat)
  * [v::hexa()](#vhexa-deprecated) *(deprecated)*
  * [v::int()](#vint)
  * [v::multiple()](#vmultiplemultipleof)
  * [v::negative()](#vnegative)
  * [v::notEmpty()](#vnotempty)
  * [v::numeric()](#vnumeric)
  * [v::odd()](#vodd)
  * [v::perfectSquare()](#vperfectsquare)
  * [v::positive()](#vpositive)
  * [v::primeNumber()](#vprimenumber)
  * [v::roman()](#vroman)
  * [v::xdigit()](#vxdigit)

### String

  * [v::alnum()](#valnum)
  * [v::alpha()](#valpha)
  * [v::between()](#vbetweenstart-end)
  * [v::charset()](#vcharset)
  * [v::consonants()](#vconsonants-deprecated) *(deprecated)*
  * [v::consonant()](#vconsonant)
  * [v::contains()](#vcontainsvalue)
  * [v::cntrl()](#vcntrl)
  * [v::digits()](#vdigits-deprecated) *(deprecated)*
  * [v::digit()](#vdigit)
  * [v::endsWith()](#vendswithvalue)
  * [v::in()](#vinhaystack)
  * [v::graph()](#vgraph)
  * [v::length()](#vlengthmin-max)
  * [v::lowercase()](#vlowercase)
  * [v::notEmpty()](#vnotempty)
  * [v::noWhitespace()](#vnowhitespace)
  * [v::prnt()](#vprnt)
  * [v::punct()](#vpunct)
  * [v::regex()](#vregexregex)
  * [v::slug()](#vslug)
  * [v::space()](#vspace)
  * [v::startsWith()](#vstartswithvalue)
  * [v::uppercase()](#vuppercase)
  * [v::version()](#vversion)
  * [v::vowels()](#vvowels-deprecated) *(deprecated)*
  * [v::vowel()](#vvowel)
  * [v::xdigit()](#vxdigit)

### Arrays

  * [v::arr()](#varr)
  * [v::contains()](#vcontainsvalue)
  * [v::each()](#veachv-validatorforvalue)
  * [v::endsWith()](#vendswithvalue)
  * [v::in()](#vinhaystack)
  * [v::key()](#vkeyname)
  * [v::length()](#vlengthmin-max)
  * [v::notEmpty()](#vnotempty)
  * [v::startsWith()](#vstartswithvalue)

### Objects

  * [v::attribute()](#vattributename)
  * [v::instance()](#vinstanceinstancename)
  * [v::length()](#vlengthmin-max)

### Date and Time

  * [v::between()](#vbetweenstart-end)
  * [v::date()](#vdate)
  * [v::leapDate()](#vleapdateformat)
  * [v::leapYear()](#vleapyear)

### Group Validators

  * [v::allOf()](#vallofv1-v2-v3)
  * [v::noneOf()](#vnoneofv1-v2-v3)
  * [v::oneOf()](#voneofv1-v2-v3)

### Regional

  * [v::tld()](#vtld)
  * [v::countryCode()](#vcountrycode)
  * [v::postalCode()](#vpostalcode)

### Files

  * [v::directory()](#vdirectory)
  * [v::executable()](#vexecutable)
  * [v::exists()](#vexists)
  * [v::file()](#vfile)
  * [v::readable()](#vreadable)
  * [v::symbolicLink()](#vsymboliclink)
  * [v::uploaded()](#vuploaded)
  * [v::writable()](#vwritable)

### Other

  * [v::cnh()](#vcnh)
  * [v::cnpj()](#vcnpj)
  * [v::cpf()](#vcpf)
  * [v::domain()](#vdomain)
  * [v::email()](#vemail)
  * [v::hexRgbColor()](#vhexrgbcolor)
  * [v::ip()](#vip)
  * [v::json()](#vjson)
  * [v::macAddress()](#vmacaddress)
  * [v::phone()](#vphone)
  * [v::sf()](#vsfsfvalidator)
  * [v::zend()](#vzendzendvalidator)
  * [v::nfeAccessKey()](#vnfeaccesskey)

### Yes/No

  * [v::yes()](#vyesuselocale--false)
  * [v::no()](#vnouselocale--false)

### Alphabetically

#### v::allOf($v1, $v2, $v3...)

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

  * [v::oneOf()](#voneofv1-v2-v3)  - Validates if at least one inner rule pass
  * [v::noneOf()](#vnoneofv1-v2-v3) - Validates if no inner rules pass
  * [v::when()](#vwhenv-if-v-then-v-else)   - A Ternary validator

#### v::alnum()
#### v::alnum(string $additionalChars)

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

  * [v::alpha()](#valpha)  - a-Z, empty or whitespace only
  * [v::digit()](#vdigit) - 0-9, empty or whitespace only
  * [v::consonant()](#vconsonant)
  * [v::vowel()](#vvowel)

#### v::alpha()
#### v::alpha(string $additionalChars)

This is similar to v::alnum(), but it doesn't allow numbers. It also
accepts empty values and whitespace, so use `v::notEmpty()` and
`v::noWhitespace()` when appropriate.

See also:

  * [v::alnum()](#valnum)  - a-z0-9, empty or whitespace only
  * [v::digit()](#vdigit) - 0-9, empty or whitespace only
  * [v::consonant()](#vconsonant)
  * [v::vowel()](#vvowel)

#### v::arr()

Validates if the input is an array or traversable object.

```php
v::arr()->validate(array()); //true
v::arr()->validate(new ArrayObject); //true
```

See also:

  * [v::each()](#veachv-validatorforvalue) - Validates each member of an array
  * [v::key()](#vkeyname)  - Validates a specific key of an array

### v::alwaysValid

Always returns true.

### v::alwaysInvalid

Always return false.

#### v::attribute($name)
#### v::attribute($name, v $validator)
#### v::attribute($name, v $validator, boolean $mandatory=true)

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

  * [v::key()](#vkeyname) - Validates a specific key of an array

#### v::between($start, $end)
#### v::between($start, $end, boolean $inclusive=false)

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

  * [v::length()](#vlengthmin-max) - Validates the length of a input
  * [v::min()](#vminmin)
  * [v::max()](#vmaxmax)

#### v::bool()

Validates if the input is a boolean value:

```php
v::bool()->validate(true); //true
v::bool()->validate(false); //true
```

#### v::call(callable $callback)

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

  * [v::callback()](#vcallbackcallable-callback) - Similar, but a different workflow.

#### v::callback(callable $callback)

This is a wildcard validator, it uses a function name, method or closure
to validate something:

```php
v::callback('is_int')->validate(10); //true
```

(Please note that this is a sample, the `v::int()` validator is much better).

As in `v::call()`, you can pass a method or closure to it.

See also:

  * [v::call()](#vcallcallable-callback) - A more elaborated building block validator

#### v::charset()

Validates if a string is in a specific charset.

```php
v::charset('ASCII', 'açúcar'); //false
v::charset('ASCII', 'sugar');  //true
v::charset(array('ISO-8859-1', 'EUC-JP'), '日本国'); // true
```

The array format is a logic OR, not AND.

#### v::cnpj()

Validates the Brazillian CNPJ number. Ignores non-digit chars, so
use `->digit()` if needed.

See also:

  * [v::cpf()](#vcpf) - Validates the Brazillian CPF number.
  * [v::cnh()](#vcnh) - Validates the Brazillian driver's license.

#### v::nfeAccessKey()

Validates the access key of the Brazilian electronic invoice (NFe).

#### v::consonants() *(deprecated)*

Validates strings that contain only consonants. It's now deprecated, consonant should be used
instead.

See also:

  * [v::consonant()](#vconsonant)


#### v::consonant()
#### v::consonant(string $additionalChars)

Similar to `v::alnum()`. Validates strings that contain only consonants:

```php
v::consonant()->validate('xkcd'); //true
```

See also:

  * [v::alnum()](#valnum)  - a-z0-9, empty or whitespace only
  * [v::digit()](#vdigit) - 0-9, empty or whitespace only
  * [v::alpha()](#valpha)  - a-Z, empty or whitespace only
  * [v::vowel()](#vvowel)

#### v::contains($value)
#### v::contains($value, boolean $identical=false)

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

  * [v::startsWith()](#vstartswithvalue)
  * [v::endsWith()](#vendswithvalue)
  * [v::in()](#vinhaystack)

#### v::cntrl
#### v::cntrl(string $additionalChars)

This is similar to `v::alnum()`, but only accepts control characters:

```php
v::cntrl()->validate("\n\r\t"); //true
```

See also:

  * [v::alnum()](#valnum)     - a-z0-9, empty or whitespace only
  * [v::prnt()](#vprnt)      - all printable characters
  * [v::space()](#vspace)     - empty or whitespace only

#### v::countryCode

Validates an ISO country code like US or BR.

```php
v::countryCode('BR'); //true
```

See also:

  * [v::tld()](#vtld) - Validates a top level domain

#### v::cnh()

Validates a Brazillian driver's license.

```php
v::cnh()->validate('02650306461');
```

See also:

  * [v::cnpj()](#vcnpj)
  * [v::cpf()](#vcpf)

#### v::cpf()

Validates a Brazillian CPF number.

```php
v::cpf()->validate('44455566820');
```

It ignores any non-digit char:

```php
v::cpf()->validate('444.555.668-20');
```

If you need to validate digits only, add `->digit()` to
the chain:

```php
v::digit()->cpf()->validate('44455566820');
```

See also:

  * [v::cnpj()](#vcnpj)
  * [v::cnh()](#vcnh)

#### v::creditCard()

Validates a credit card number.

```php
v::creditCard()->validate($myCredCardNumber);
```

It ignores any non-digit chars, so use `->digit()` when appropriate.

```php
v::digit()->creditCard()->validate($myCredCardNumber);
```

#### v::date()
#### v::date($format)

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

  * [v::between()](#vbetweenstart-end)
  * [v::minimumAge()](#vminimumageage)
  * [v::leapDate()](#vleapdateformat)
  * [v::leapYear()](#vleapyear)

#### v::digits() *(deprecated)*

Validates 0-9, empty or whitespace only. It's now deprecated, digit should be used
instead.

See also:

  * [v::digit()](#vdigit)

#### v::digit()

This is similar to v::alnum(), but it doesn't allow a-Z. It also
accepts empty values and whitespace, so use `v::notEmpty()` and
`v::noWhitespace()` when appropriate.

See also:

  * [v::alnum()](#valnum)  - a-z0-9, empty or whitespace only
  * [v::alpha()](#valpha)  - a-Z, empty or whitespace only
  * [v::vowel()](#vvowel)
  * [v::consonant()](#vconsonant)

#### v::domain()
#### v::domain($checkTLD=true)

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

  * [v::tld()](#vtld)
  * [v::ip()](#vip)

#### v::directory()

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

  * [v::exists()](#vexists)
  * [v::file()](#vfile)

#### v::each(v $validatorForValue)
#### v::each(null, v $validatorForKey)
#### v::each(v $validatorForValue, v $validatorForKey)

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

  * [v::key()](#vkeyname)
  * [v::arr()](#varr)

#### v::email()

Validates an email address.

```php
v::email()->validate('alexandre@gaigalas.net'); //true
```

#### v::executable()

Validates if a file is an executable.

```php
v::email()->executable('script.sh'); //true
```

See also

  * [v::readable()](#vreadable)
  * [v::writable()](#vwritable)

#### v::exists()

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

  * [v::directory()](#vdirectory)
  * [v::file()](#vfile)

#### v::endsWith($value)
#### v::endsWith($value, boolean $identical=false)

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

  * [v::startsWith()](#vstartswithvalue)
  * [v::contains()](#vcontainsvalue)
  * [v::in()](#vin)

#### v::equals($value)
#### v::equals($value, boolean $identical=false)

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

  * [v::contains()](#vcontainsvalue)

#### v::even()

Validates an even number.

```php
v::int()->even()->validate(2); //true
```

Using `int()` before `even()` is a best practice.

See also

  * [v::odd()](#vodd)
  * [v::multiple()](#vmultiplemultipleof)

#### v::file()

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

  * [v::directory()](#vdirectory)
  * [v::exists()](#vexists)

#### v::float()

Validates a floating point number.

```php
v::float()->validate(1.5); //true
v::float()->validate('1e5'); //true
```

#### v::graph()
#### v::graph(string $additionalChars)

Validates all characters that are graphically represented.

```php
v::graph()->validate('LKM@#$%4;'); //true
```

See also:

  * [v::prnt()](#vprnt)

#### v::hexa() *(deprecated)*

Validates an hexadecimal number. It's now deprecated, xdigit should be used
instead.

```php
v::hexa()->validate('AF12'); //true
```

See also:

  * [v::xdigit()](#vxdigit)

#### v::hexRgbColor()

Validates a hex RGB color

```php
v::hexRgbColor()->validate('#FFFAAA'); //true
v::hexRgbColor()->validate('123123'); //true
v::hexRgbColor()->validate('FCD'); //true
```

See also:

  * [v::vxdigit()](#vxdigit)

#### v::in($haystack)
#### v::in($haystack, boolean $identical=false)

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

  * [v::startsWith()](#vstartswithvalue)
  * [v::endsWith()](#vendswithvalue)
  * [v::contains()](#vcontainsvalue)

#### v::instance($instanceName)

Validates if the input is an instance of the given class or interface.

```php
v::instance('DateTime')->validate(new DateTime); //true
v::instance('Traversable')->validate(new ArrayObject); //true
```

Message template for this validator includes `{{instanceName}}`.

See also:

  * [v::object()](#vobject)

#### v::int()

Validates if the input is an integer.

```php
v::int()->validate('10'); //true
v::int()->validate(10); //true
```

See also:

  * [v::numeric()](#vnumeric)
  * [v::digit()](#vdigit)

#### v::ip()
#### v::ip($options)

Validates IP Addresses. This validator uses the native filter_var()
PHP function.

```php
v::ip()->validate('192.168.0.1');
```

You can pass a parameter with filter_var flags for IP.

```php
v::ip(FILTER_FLAG_NO_PRIV_RANGE)->validate('127.0.0.1'); //false
```

#### v::json()

Validates if the given input is a valid JSON.

```php
v::json()->validate('{"foo":"bar"}'); //true
```

#### v::key($name)
#### v::key($name, v $validator)
#### v::key($name, v $validator, boolean $mandatory=true)

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

  * [v::attribute()](#vattributename) - Validates a specific attribute of an object

#### v::leapDate($format)

Validates if a date is leap.

```php
v::leapDate('Y-m-d')->validate('1988-02-29'); //true
```

This validator accepts DateTime instances as well. The $format
parameter is mandatory.

See also:

  * [v::date()](#vdate)
  * [v::leapYear()](#vleapyear)

#### v::leapYear()

Validates if a year is leap.

```php
v::leapYear()->validate('1988'); //true
```

This validator accepts DateTime instances as well.

See also:

  * [v::date()](#vdate)
  * [v::leapDate()](#vleapdateformat)

#### v::length($min, $max)
#### v::length($min, null)
#### v::length(null, $max)
#### v::length($min, $max, boolean $inclusive=true)

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

  * [v::between()](#vbetweenstart-end) - Validates ranges

#### v::lowercase()

Validates if string characters are lowercase in the input:

```php
v::string()->lowercase()->validate('xkcd'); //true
```

See also:

  * [v::uppercase()](#vuppercase)

#### v::macAddress()

Validates a Mac Address.

```php
v::macAddress()->validate('00:11:22:33:44:55'); //true
v::macAddress()->validate('af-AA-22-33-44-55'); //true
```

#### v::max($max)
#### v::max($max, boolean $inclusive=false)

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

`true` may be passed as a parameter to indicate that inclusive
values must be used.

Message template for this validator includes `{{maxValue}}`.

See also:

  * [v::min()](#vminmin)
  * [v::between()](#vbetweenstart-end)

#### v::min($min)
#### v::min($min, boolean $inclusive=false)

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

  * [v::max()](#vmaxmax)
  * [v::between()](#vbetweenstart-end)

#### v::minimumAge($age)

Validates a minimum age for a given date.

```php
v::date()->minimumAge(18)->validate('1987-01-01'); //true
```

Using `date()` before is a best-practice.

Message template for this validator includes `{{age}}`.

See also:

  * [v::date()](#vdate)

#### v::multiple($multipleOf)

Validates if the input is a multiple of the given parameter

```php
v::int()->multiple(3)->validate(9); //true
```

See also:

  * [v::primeNumber()](#vprimenumber)

#### v::negative()

Validates if a number is lower than zero

```php
v::numeric()->negative()->validate(-15); //true
```

See also:

  * [v::positive()](#vpositive)

#### v::no($useLocale = false)

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

If `$useLocale` is TRUE, uses the value of [nl_langinfo()](http://php.net/nl_langinfo) with `NOEXPR` constant.

See also:

  * [v::yes()](#vyesuselocale--false)

#### v::noWhitespace()

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

#### v::noneOf($v1, $v2, $v3...)

Validates if NONE of the given validators validate:

```php
v::noneOf(
    v::int(),
    v::float()
)->validate('foo'); //true
```

In the sample above, 'foo' isn't a integer nor a float, so noneOf returns true.

See also:

  * [v::not()](#vnotv-negatedvalidator)
  * [v::allOf()](#vallofv1-v2-v3)
  * [v::oneOf()](#voneofv1-v2-v3)

#### v::not(v $negatedValidator)

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

  * [v::noneOf()](#vnoneofv1-v2-v3)

#### v::notEmpty()

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

  * [v::noWhitespace()](#noWhitespace)
  * [v::nullValue()](#vnullvalue)

#### v::nullValue()

Validates if the input is null. This rule does not allow empty strings to avoid ambiguity.

```php
v::nullValue()->validate(null); //true
```

See also:

  * [v::notEmpty()](#vnotempty)

#### v::numeric()

Validates on any numeric value.

```php
v::numeric()->validate(-12); //true
v::numeric()->validate('135.0'); //true
```

See also:

  * [v::int()](#vint)
  * [v::digit()](#vdigit)

#### v::object()

Validates if the input is an object.

```php
v::object()->validate(new stdClass); //true
```

See also:

  * [v::instance()](#vinstanceinstancename)
  * [v::attribute()](#vattributename)

#### v::odd()

Validates an odd number.

```php
v::int()->odd()->validate(3); //true
```

Using `int()` before `odd()` is a best practice.

See also

  * [v::even()](#veven)
  * [v::multiple()](#vmultiplemultipleof)

#### v::oneOf($v1, $v2, $v3...)

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

  * [v::allOf()](#vallofv1-v2-v3)  - Similar to oneOf, but act as an AND operator
  * [v::noneOf()](#vnoneofv1-v2-v3) - Validates if NONE of the inner rules validates
  * [v::when()](#vwhenv-if-v-then-v-else)   - A ternary validator

#### v::perfectSquare()

Validates a perfect square.

```php
v::perfectSquare()->validate(25); //true (5*5)
v::perfectSquare()->validate(9); //true (3*3)
```
#### v::phone()

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

#### v::positive()

Validates if a number is higher than zero

```php
v::numeric()->positive()->validate(-15); //false
```

See also:

  * [v::negative()](#vnegative)

#### v::postalCode($countryCode)

Validates a postal code according to the given country code.

```php
v::numeric()->postalCode('BR')->validate('02179000'); //true
v::numeric()->postalCode('BR')->validate('02179-000'); //true
v::numeric()->postalCode('US')->validate('02179-000'); //false
```

Extracted from [GeoNames](http://www.geonames.org/).

See also:

  * [v::countryCode()](#vcountrycode)

#### v::primeNumber()

Validates a prime number

```php
v::primeNumber()->validate(7); //true
```

#### v::prnt()
#### v::prnt(string $additionalChars)

Similar to `v::graph` but accepts whitespace.

```php
v::prnt()->validate('LMKA0$% _123'); //true
```

See also:

  * [v::graph()](#vgraph)

#### v::punct()
#### v::punct(string $additionalChars)

Accepts only punctuation characters:

```php
v::punct()->validate('&,.;[]'); //true
```

See also:

  * [v::cntrl()](#vcntrl)
  * [v::graph()](#vgraph)
  * [v::prnt()](#vprnt)

#### v::readable()

Validates if the given data is a file exists and is readable.

```php
v::readable()->validate('/path/of/a/readable/file'); //true
```

#### v::regex($regex)

Evaluates a regex on the input and validates if matches

```php
v::regex('/[a-z]/')->validate('a'); //true
```

Message template for this validator includes `{{regex}}`

#### v::roman()

Validates roman numbers

```php
v::roman()->validate('IV'); //true
```

This validator ignores empty values, use `notEmpty()` when
appropriate.

#### v::sf($sfValidator)

Use Symfony2 validators inside Respect\Validation flow. Messages
are preserved.

```php
v::sf('Time')->validate('15:00:00');
```

You must add Symfony2 to your autoloading routines.

See also:

  * [v::zend()](#vzendzendvalidator)

#### v::slug()

Validates slug-like strings:

```php
v::slug()->validate('my-wordpress-title'); //true
v::slug()->validate('my-wordpress--title'); //false
v::slug()->validate('my-wordpress-title-'); //false
```

#### v::space()
#### v::space(string $additionalChars)

Accepts only whitespace:

```php
v::space()->validate('    '); //true
```

See also:

  * [v::cntrl()](#vcntrl)

#### v::startsWith($value)
#### v::startsWith($value, boolean $identical=false)

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

  * [v::endsWith()](#vendswithvalue)
  * [v::contains()](#vcontainsvalue)
  * [v::in()](#vin)

#### v::string()

Validates a string.

```php
v::string()->validate('hi'); //true
```

See also:

  * [v::alnum()](#valnum)

#### v::symbolicLink()

Validates if the given data is a path of a valid symbolic link.

```php
v::symbolicLink()->validate('/path/of/valid/symbolic/link'); //true
```

#### v::tld()

Validates a top-level domain

```php
v::tld()->validate('com'); //true
v::tld()->validate('ly'); //true
v::tld()->validate('org'); //true
```

See also

 * [v::domain()](#vdomain) - Validates domain names
 * [v::countryCode()](#vcountrycode) - Validates ISO country codes

#### v::uploaded()

Validates if the given data is a file that was uploaded via HTTP POST.

```php
v::uploaded()->validate('/path/of/an/uploaded/file'); //true
```

#### v::uppercase()

Validates if string characters are uppercase in the input:

```php
v::string()->uppercase()->validate('W3C'); //true
```

See also:

  * [v::lowercase()](#vlowercase)

#### v::version()

Validates version numbers using Semantic Versioning.

```php
v::version()->validate('1.0.0');
```

#### v::vowels() *(deprecated)*

Validates strings that contains only vowels. It's now deprecated, vowel should be used
instead.

See also:

  * [v::vowel()](#vvowel)


#### v::vowel()

Similar to `v::alnum()`. Validates strings that contains only vowels:

```php
v::vowel()->validate('aei'); //true
```

See also:

  * [v::alnum()](#valnum)  - a-z0-9, empty or whitespace only
  * [v::digit()](#vdigit) - 0-9, empty or whitespace only
  * [v::alpha()](#valpha)  - a-Z, empty or whitespace only
  * [v::consonant()](#vconsonant)

#### v::when(v $if, v $then, v $else)

A ternary validator that accepts three parameters.

When the $if validates, returns validation for $then.
When the $if doesn't validate, returns validation for $else.

```php
v::when(v::int(), v::positive(), v::notEmpty())->validate($input);
```

In the sample above, if `$input` is an integer, then it must be positive.
If `$input` is not an integer, then it must not me empty.

See also:

  * [v::allOf()](#vallofv1-v2-v3)
  * [v::oneOf()](#voneofv1-v2-v3)
  * [v::noneOf()](#vnoneofv1-v2-v3)

#### v::xdigit()

Accepts an hexadecimal number:

```php
v::xdigit()->validate('abc123'); //true
```

Notice, however, that it doesn't accept strings starting with 0x:

```php
v::xdigit()->validate('0x1f'); //false
```

See also:

  * [v::digit()](#vdigit)
  * [v::alnum()](#valnum)
  * [v::hexRgbColor()](#vhexrgbcolor)

#### v::yes($useLocale = false)

Validates if value is considered as "Yes".

```php
v::yes()->validate('Y');//true
v::yes()->validate('Yea');//true
v::yes()->validate('Yeah');//true
v::yes()->validate('Yep');//true
v::yes()->validate('Yes');//true
```

This rule is case insensitive.

If `$useLocale` is TRUE, uses the value of [nl_langinfo()](http://php.net/nl_langinfo) with `YESEXPR` constant.

See also:

  * [v::no()](#vnouselocale--false)

#### v::writable()

Validates if the given data is a file exists and is writable.

```php
v::writable()->validate('/path/of/a/writable/file'); //true
```

#### v::zend($zendValidator)

Use Zend validators inside Respect\Validation flow. Messages
are preserved.

```php
v::zend('Hostname')->validate('google.com');
```

You need to put Zend Framework in your autoload routines.

See also:

  * [v::sf()](#vsfsfvalidator)

[PunnyCode]: http://en.wikipedia.org/wiki/Punycode "Wikipedia: Punnycode"
[IDNA]: http://en.wikipedia.org/wiki/Internationalized_domain_name#Internationalizing_Domain_Names_in_Applications "Wikipedia: Internationalized domain name"
