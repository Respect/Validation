Respect\Validation
==================

[![Build Status](https://secure.travis-ci.org/Respect/Validation.png)](http://travis-ci.org/Respect/Validation) [![Latest Stable Version](https://poser.pugx.org/respect/validation/v/stable.png)](https://packagist.org/packages/respect/validation) [![Total Downloads](https://poser.pugx.org/respect/validation/downloads.png)](https://packagist.org/packages/respect/validation) [![Latest Unstable Version](https://poser.pugx.org/respect/validation/v/unstable.png)](https://packagist.org/packages/respect/validation) [![License](https://poser.pugx.org/respect/validation/license.png)](https://packagist.org/packages/respect/validation)

[The most awesome validation engine ever created for PHP.](http://bit.ly/1a1oeQv)

- Complex (custom) rules made simple: `v::numeric()->positive()->between(1, 256)->validate($myNumber)`.
- Awesome (customizable, iterable) exceptions.
- >80 (fully tested) validators.

Installation
------------

Packages available on [PEAR](http://respect.li/pear) and [Composer](http://packagist.org/packages/Respect/Validation). Autoloading is [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md) compatible.

Feature Guide
-------------

### Namespace Import

Respect\Validation is namespaced, but you can make your life easier by importing
a single class into your context:

    <?php
    use Respect\Validation\Validator as v;

### Simple Validation

The Hello World validator is something like this:

    $number = 123;
    v::numeric()->validate($number); //true

### Chained Validation

It is possible to use validators in a chain. Sample below validates a string
containing numbers and letters, no whitespace and length between 1 and 15.

    $usernameValidator = v::alnum()->noWhitespace()->length(1,15);
    $usernameValidator->validate('alganet'); //true

### Validating Object Attributes

Given this simple object:

    $user = new stdClass;
    $user->name = 'Alexandre';
    $user->birthdate = '1987-07-01';

Is possible to validate its attributes in a single chain:

    $userValidator = v::attribute('name', v::string()->length(1,32))
                      ->attribute('birthdate', v::date()->minimumAge(18));

    $userValidator->validate($user); //true

Validating array keys is also possible using `v::key()`

Note that we used `v::string()` and `v::date()` in the beginning of the validator.
Although is not mandatory, it is a good practice to use the type of the
validated object as the first node in the chain.

### Input optional

All validators treat input as optional and will accept empty string input as valid,
unless otherwise stated in the documentation.

We us the `v:notEmpty()` validator prefixed to disallow empty input and effectively
define the field as mandatory as input will be required or validation will fail.

    v::string()->notEmpty()->validate(''); //false input required

### Negating Rules

You can use the `v::not()` to negate any rule:

    v::not(v::int())->validate(10); //false, input must not be integer

### Validator Reuse

Once created, you can reuse your validator anywhere. Remember $usernameValidator?

    $usernameValidator->validate('respect');            //true
    $usernameValidator->validate('alexandre gaigalas'); //false
    $usernameValidator->validate('#$%');                //false

### Informative Exceptions

When something goes wrong, Validation can tell you exactly what's going on. For this,
we use the `assert()` method instead of `validate()`:

    try {
        $usernameValidator->assert('really messed up screen#name');
    } catch(\InvalidArgumentException $e) {
       echo $e->getFullMessage();
    }

The printed message is exactly this, as a text tree:

    \-All of the 3 required rules must pass
      |-"really messed up screen#name" must contain only letters (a-z) and digits (0-9)
      |-"really messed up screen#name" must not contain whitespace
      \-"really messed up screen#name" must have a length between 1 and 15

### Getting Messages

The text tree is fine, but unusable on a HTML form or something more custom. You can use
`findMessages()` for that:

    try {
        $usernameValidator->assert('really messed up screen#name');
    } catch(\InvalidArgumentException $e) {
       var_dump($e->findMessages(array('alnum', 'length', 'noWhitespace')));
    }

`findMessages()` returns an array with messages from the requested validators.

### Custom Messages

Getting messages as an array is fine, but sometimes you need to customize them in order
to present them to the user. This is possible using the `findMessages()` method as well:

       $errors = $e->findMessages(array(
            'alnum'        => '{{name}} must contain only letters and digits',
            'length'       => '{{name}} must not have more than 15 chars',
            'noWhitespace' => '{{name}} cannot contain spaces'
        ));

For all messages, the `{{name}}` and `{{input}}` variable is available for templates.

### Validator Name

On `v::attribute()` and `v::key()`, `{{name}}` is the attribute/key name. For others,
is the same as the input. You can customize a validator name using:

    v::date('Y-m-d')->between('1980-02-02', 'now')->setName('Member Since');


### Zend/Symfony Validators

It is also possible to reuse validators from other frameworks if they are installed:

    $hostnameValidator = v::zend('Hostname')->assert('google.com');
    $timeValidator     = v::sf('Time')->assert('22:00:01');

### Validation Methods

We've seen `validate()` that returns true or false and `assert()` that throws a complete
validation report. There is also a `check()` method that returns an Exception
only with the first error found:

    try {
        $usernameValidator->check('really messed up screen#name');
    } catch(\InvalidArgumentException $e) {
       echo $e->getMainMessage();
    }

Message:

    "really messed up screen#name" must contain only letters (a-z) and digits (0-9)

Reference
---------

### Types

  * v::arr()
  * v::bool()
  * v::date()
  * v::float()
  * v::hexa() *(deprecated)*
  * v::instance()
  * v::int()
  * v::nullValue()
  * v::numeric()
  * v::object()
  * v::string()
  * v::xdigit()

### Generics

  * v::call()
  * v::callback()
  * v::not()
  * v::when()
  * v::alwaysValid()
  * v::alwaysInvalid()

### Comparing Values

  * v::between()
  * v::equals()
  * v::max()
  * v::min()

### Numeric

  * v::between()
  * v::bool()
  * v::even()
  * v::float()
  * v::hexa() *(deprecated)*
  * v::int()
  * v::multiple()
  * v::negative()
  * v::notEmpty()
  * v::numeric()
  * v::odd()
  * v::perfectSquare()
  * v::positive()
  * v::primeNumber()
  * v::roman()
  * v::xdigit()

### String

  * v::alnum()
  * v::alpha()
  * v::between()
  * v::charset()
  * v::consonants() *(deprecated)*
  * v::consonant()
  * v::contains()
  * v::cntrl()
  * v::digits() *(deprecated)*
  * v::digit()
  * v::endsWith()
  * v::in()
  * v::graph()
  * v::length()
  * v::lowercase()
  * v::notEmpty()
  * v::noWhitespace()
  * v::prnt()
  * v::punct()
  * v::regex()
  * v::slug()
  * v::space()
  * v::startsWith()
  * v::uppercase()
  * v::uppercase()
  * v::version()
  * v::vowels() *(deprecated)*
  * v::vowel()
  * v::xdigit()

### Arrays

  * v::arr()
  * v::contains()
  * v::each()
  * v::endsWith()
  * v::in()
  * v::key()
  * v::length()
  * v::notEmpty()
  * v::startsWith()

### Objects

  * v::attribute()
  * v::instance()
  * v::length()

### Date and Time

  * v::between()
  * v::date()
  * v::leapDate()
  * v::leapYear()

### Group Validators

  * v::allOf()
  * v::noneOf()
  * v::oneOf()

### Regional

  * v::tld()
  * v::countryCode()

### Files

  * v::directory()
  * v::exists()
  * v::file()
  * v::readable()
  * v::symbolicLink()
  * v::uploaded()
  * v::writable()

### Other

  * v::cnh()
  * v::cnpj()
  * v::cpf()
  * v::domain()
  * v::email()
  * v::ip()
  * v::json()
  * v::macAddress()
  * v::phone()
  * v::sf()
  * v::zend()
  * v::nfeAccessKey()

### Alphabetically

#### v::allOf($v1, $v2, $v3...)

Will validate if all inner validators validates.

    v::allOf(
        v::int(),
        v::positive()
    )->validate(15); //true

This is similar to the chain (which is an allOf already), but
its syntax allows you to set custom names for every node:

    v::allOf(
        v::int()->setName('Account Number'),
        v::positive()->setName('Higher Than Zero')
    )->setName('Positive integer')
     ->validate(15); //true

See also:

  * v::oneOf()  - Validates if at least one inner rule pass
  * v::noneOf() - Validates if no inner rules pass
  * v::when()   - A Ternary validator

#### v::alnum()
#### v::alnum(string $additionalChars)

Validates alphanumeric characters from a-Z and 0-9.

    v::alnum()->validate('foo 123'); //true

A parameter for extra characters can be used:

    v::alnum('-')->validate('foo - 123'); //true

This validator allows whitespace, if you want to
remove them add `->noWhitespace()` to the chain:

    v::alnum()->noWhitespace->validate('foo 123'); //false

By default empty values are allowed, if you want
to invalidate them, add `->notEmpty()` to the chain:

    v::alnum()->notEmpty()->validate(''); //false

You can restrict case using the `->lowercase()` and
`->uppercase()` validators:

    v::alnum()->uppercase()->validate('aaa'); //false

Message template for this validator includes `{{additionalChars}}` as
the string of extra chars passed as the parameter.

See also:

  * v::alpha()  - a-Z, empty or whitespace only
  * v::digit() - 0-9, empty or whitespace only
  * v::consonant()
  * v::vowel()

#### v::alpha()
#### v::alpha(string $additionalChars)

This is similar to v::alnum(), but it doesn't allow numbers. It also
accepts empty values and whitespace, so use `v::notEmpty()` and
`v::noWhitespace()` when appropriate.

See also:

  * v::alnum()  - a-z0-9, empty or whitespace only
  * v::digit() - 0-9, empty or whitespace only
  * v::consonant()
  * v::vowel()

#### v::arr()

Validates if the input is an array or traversable object.

    v::arr()->validate(array()); //true
    v::arr()->validate(new ArrayObject); //true

See also:

  * v::each() - Validates each member of an array
  * v::key()  - Validates a specific key of an array

### v::alwaysValid

Always returns true.

### v::alwaysInvalid

Always return false.

#### v::attribute($name)
#### v::attribute($name, v $validator)
#### v::attribute($name, v $validator, boolean $mandatory=true)

Validates an object attribute.

    $obj = new stdClass;
    $obj->foo = 'bar';

    v::attribute('foo')->validate($obj); //true

You can also validate the attribute itself:

    v::attribute('foo', v::equals('bar'))->validate($obj); //true

Third parameter makes the attribute presence optional:

    v::attribute('lorem', v::string(), false)->validate($obj); // true

The name of this validator is automatically set to the attribute name.

See also:

  * v::key() - Validates a specific key of an array

#### v::between($start, $end)
#### v::between($start, $end, boolean $inclusive=false)

Validates ranges. Most simple example:

    v::int()->between(10, 20)->validate(15); //true

The type as the first validator in a chain is a good practice,
since between accepts many types:

    v::string()->between('a', 'f')->validate('c'); //true

Also very powerful with dates:

    v::date()->between('2009-01-01', '2013-01-01')->validate('2010-01-01'); //true

Date ranges accept strtotime values:

    v::date()->between('yesterday', 'tomorrow')->validate('now'); //true

A third parameter may be passed to validate the passed values inclusive:

    v::date()->between(10, 20, true)->validate(20); //true

Message template for this validator includes `{{minValue}}` and `{{maxValue}}`.

See also:

  * v::length() - Validates the length of a input
  * v::min()
  * v::max()

#### v::bool()

Validates if the input is a boolean value:

    v::bool()->validate(true); //true
    v::bool()->validate(false); //true

#### v::call(callable $callback)

This is a very low level validator. It calls a function, method or closure
for the input and then validates it. Consider the following variable:

    $url = 'http://www.google.com/search?q=respect.github.com'

To validate every part of this URL we could use the native `parse_url`
function to break its parts:

    $parts = parse_url($url);

This function returns an array containing `scheme`, `host`, `path` and `query`.
We can validate them this way:

    v::arr()->key('scheme', v::startsWith('http'))
            ->key('host',   v::domain())
            ->key('path',   v::string())
            ->key('query',  v::notEmpty());

Using `v::call()` you can do this in a single chain:

    v::call(
        'parse_url',
         v::arr()->key('scheme', v::startsWith('http'))
            ->key('host',   v::domain())
            ->key('path',   v::string())
            ->key('query',  v::notEmpty())
    )->validate($url);

It is possible to call methods and closures as the first parameter:

    v::call(array($myObj, 'methodName'), v::int())->validate($myInput);
    v::call(function($input) {}, v::int())->validate($myInput);

See also:

  * v::callback() - Similar, but a different workflow.

#### v::callback(callable $callback)

This is a wildcard validator, it uses a function name, method or closure
to validate something:

    v::callback('is_int')->validate(10); //true

(Please note that this is a sample, the `v::int()` validator is much better).

As in `v::call()`, you can pass a method or closure to it.

See also:

  * v::call() - A more elaborated building block validator

#### v::charset()

Validates if a string is in a specific charset.


    v::charset('ASCII', 'açúcar'); //false
    v::charset('ASCII', 'sugar');  //true
    v::charset(array('ISO-8859-1', 'EUC-JP'), '日本国'); // true

The array format is a logic OR, not AND.

#### v::cnpj()

Validates the Brazillian CNPJ number. Ignores non-digit chars, so
use `->digit()` if needed.

See also:

  * v::cpf() - Validates the Brazillian CPF number.
  * v::cnh() - Validates the Brazillian driver's license.

#### v::nfeAccessKey()

Validates the access key of the Brazilian electronic invoice (NFe).

#### v::consonants() *(deprecated)*

Validates strings that contain only consonants. It's now deprecated, consonant should be used
instead.

See also:

  * v::consonant()


#### v::consonant()
#### v::consonant(string $additionalChars)

Similar to `v::alnum()`. Validates strings that contain only consonants:

    v::consonant()->validate('xkcd'); //true

See also:

  * v::alnum()  - a-z0-9, empty or whitespace only
  * v::digit() - 0-9, empty or whitespace only
  * v::alpha()  - a-Z, empty or whitespace only
  * v::vowel()

#### v::contains($value)
#### v::contains($value, boolean $identical=false)

For strings:

    v::contains('ipsum')->validate('lorem ipsum'); //true

For arrays:

    v::contains('ipsum')->validate(array('ipsum', 'lorem')); //true

A second parameter may be passed for identical comparison instead
of equal comparison.

Message template for this validator includes `{{containsValue}}`.

See also:

  * v::startsWith()
  * v::endsWith()
  * v::in()

#### v::cntrl
#### v::cntrl(string $additionalChars)

This is similar to `v::alnum()`, but only accepts control characters:

    v::cntrl()->validate("\n\r\t"); //true

See also:

  * v::alnum()     - a-z0-9, empty or whitespace only
  * v::prnt()      - all printable characters
  * v::space()     - empty or whitespace only

#### v::countryCode

Validates an ISO country code like US or BR.

    v::countryCode('BR'); //true

See also:

  * v::tld() - Validates a top level domain

#### v::cnh()

Validates a Brazillian driver's license.

    v::cnh()->validate('02650306461');

See also:

  * v::cnpj()
  * v::cpf()

#### v::cpf()

Validates a Brazillian CPF number.

    v::cpf()->validate('44455566820');

It ignores any non-digit char:

    v::cpf()->validate('444.555.668-20');

If you need to validate digits only, add `->digit()` to
the chain:

    v::digit()->cpf()->validate('44455566820');

See also:

  * v::cnpj()
  * v::cnh()

#### v::creditCard()

Validates a credit card number.

    v::creditCard()->validate($myCredCardNumber);

It ignores any non-digit chars, so use `->digit()` when appropriate.

    v::digit()->creditCard()->validate($myCredCardNumber);

#### v::date()
#### v::date($format)

Validates if input is a date:

    v::date()->validate('2009-01-01'); //true

Also accepts strtotime values:

    v::date()->validate('now'); //true

And DateTime instances:

    v::date()->validate(new DateTime); //true

You can pass a format when validating strings:

    v::date('Y-m-d')->validate('01-01-2009'); //false

Format has no effect when validating DateTime instances.

Message template for this validator includes `{{format}}`.

See also:

  * v::between()
  * v::minimumAge()
  * v::leapDate()
  * v::leapYear()

#### v::digits() *(deprecated)*

Validates 0-9, empty or whitespace only. It's now deprecated, digit should be used
instead.

See also:

  * v::digit()

#### v::digit()

This is similar to v::alnum(), but it doesn't allow a-Z. It also
accepts empty values and whitespace, so use `v::notEmpty()` and
`v::noWhitespace()` when appropriate.

See also:

  * v::alnum()  - a-z0-9, empty or whitespace only
  * v::alpha()  - a-Z, empty or whitespace only
  * v::vowel()
  * v::consonant()

#### v::domain()
#### v::domain($checkTLD=true)

Validates domain names.

    v::domain()->validate('google.com');

You can skip *top level domain* (TLD) checks to validate internal
domain names:

    v::domain(false)->validate('dev.machine.local')

This is a composite validator, it validates several rules
internally:

  * If input is an IP address, it validates.
  * If input contains whitespace, it fails.
  * If input not contains any dot, it fails.
  * If input has less than two parts, it fails.
  * Input must end with a top-level-domain to pass (if not skipped).
  * Each part must be alphanumeric and not start with an hyphen.
  * [PunnyCode][] is accepted for [Internationalizing Domain Names in Applications][IDNA].

Messages for this validator will reflect rules above.

See also:

  * v::tld()
  * v::ip()

#### v::directory()

Validates directories.

    v::directory()->validate(__DIR__); //true
    v::directory()->validate(__FILE__); //false

This validator will consider SplFileInfo instances, so you can do something like:

    v::directory()->validate(new \SplFileInfo($directory));

See also

  * v::exists()
  * v::file()

#### v::each(v $validatorForValue)
#### v::each(null, v $validatorForKey)
#### v::each(v $validatorForValue, v $validatorForKey)

Iterates over an array or Iterator and validates the value or key
of each entry:

    $releaseDates = array(
        'validation' => '2010-01-01',
        'template'   => '2011-01-01',
        'relational' => '2011-02-05',
    );

    v::arr()->each(v::date())->validate($releaseDates); //true
    v::arr()->each(v::date(), v::string()->lowercase())->validate($releaseDates); //true

Using `arr()` before `each()` is a best practice.

See also:

  * v::key()
  * v::arr()

#### v::email()

Validates an email address.

    v::email()->validate('alexandre@gaigalas.net'); //true

#### v::exists()

Validates files or directories.

    v::exists()->validate(__FILE__); //true
    v::exists()->validate(__DIR__); //true

This validator will consider SplFileInfo instances, so you can do something like:

    v::exists()->validate(new \SplFileInfo($file));

See also

  * v::directory()
  * v::file()

#### v::endsWith($value)
#### v::endsWith($value, boolean $identical=false)

This validator is similar to `v::contains()`, but validates
only if the value is at the end of the input.

For strings:

    v::endsWith('ipsum')->validate('lorem ipsum'); //true

For arrays:

    v::endsWith('ipsum')->validate(array('lorem', 'ipsum')); //true

A second parameter may be passed for identical comparison instead
of equal comparison.

Message template for this validator includes `{{endValue}}`.

See also:

  * v::startsWith()
  * v::contains()
  * v::in()

#### v::equals($value)
#### v::equals($value, boolean $identical=false)

Validates if the input is equal some value.

    v::equals('alganet')->validate('alganet'); //true

Identical validation (===) is possible:

    v::equals(10)->validate('10'); //true
    v::equals(10, true)->validate('10'); //false

Message template for this validator includes `{{compareTo}}`.

See also:

  * v::contains()

#### v::even()

Validates an even number.

    v::int()->even()->validate(2); //true

Using `int()` before `even()` is a best practice.

See also

  * v::odd()
  * v::multiple()

#### v::file()

Validates files.

    v::file()->validate(__FILE__); //true
    v::file()->validate(__DIR__); //false

This validator will consider SplFileInfo instances, so you can do something like:

    v::file()->validate(new \SplFileInfo($file));

See also

  * v::directory()
  * v::exists()

#### v::float()

Validates a floating point number.

    v::float()->validate(1.5); //true
    v::float()->validate('1e5'); //true

#### v::graph()
#### v::graph(string $additionalChars)

Validates all characters that are graphically represented.

    v::graph()->validate('LKM@#$%4;'); //true

See also:

  * v::prnt()

#### v::hexa() *(deprecated)*

Validates an hexadecimal number. It's now deprecated, xdigit should be used
instead.

    v::hexa()->validate('AF12'); //true

See also:

  * v::xdigit()

#### v::in($haystack)
#### v::in($haystack, boolean $identical=false)

Validates if the input is contained in a specific haystack.

For strings:

    v::in('lorem ipsum')->validate('ipsum'); //true

For arrays:

    v::in(array('lorem', 'ipsum'))->validate('lorem'); //true

A second parameter may be passed for identical comparison instead
of equal comparison.

Message template for this validator includes `{{haystack}}`.

See also:

  * v::startsWith()
  * v::endsWith()
  * v::contains()

#### v::instance($instanceName)

Validates if the input is an instance of the given class or interface.

    v::instance('DateTime')->validate(new DateTime); //true
    v::instance('Traversable')->validate(new ArrayObject); //true

Message template for this validator includes `{{instanceName}}`.

See also:

  * v::object()

#### v::int()

Validates if the input is an integer.

    v::int()->validate('10'); //true
    v::int()->validate(10); //true

See also:

  * v::numeric()
  * v::digit()

#### v::ip()
#### v::ip($options)

Validates IP Addresses. This validator uses the native filter_var()
PHP function.

    v::ip()->validate('192.168.0.1');

You can pass a parameter with filter_var flags for IP.

    v::ip(FILTER_FLAG_NO_PRIV_RANGE)->validate('127.0.0.1'); //false

#### v::json()

Validates if the given input is a valid JSON.

    v::json->validate('{"foo":"bar"}'); //true

#### v::key($name)
#### v::key($name, v $validator)
#### v::key($name, v $validator, boolean $mandatory=true)

Validates an array key.

    $dict = array(
        'foo' => 'bar'
    );

    v::key('foo')->validate($dict); //true

You can also validate the key value itself:

    v::key('foo', v::equals('bar'))->validate($dict); //true

Third parameter makes the key presence optional:

    v::key('lorem', v::string(), false)->validate($dict); // true

The name of this validator is automatically set to the key name.

See also:

  * v::attribute() - Validates a specific attribute of an object

#### v::leapDate($format)

Validates if a date is leap.

    v::leapDate('Y-m-d')->validate('1988-02-29'); //true

This validator accepts DateTime instances as well. The $format
parameter is mandatory.

See also:

  * v::date()
  * v::leapYear()

#### v::leapYear()

Validates if a year is leap.

    v::leapYear()->validate('1988'); //true

This validator accepts DateTime instances as well.

See also:

  * v::date()
  * v::leapDate()

#### v::length($min, $max)
#### v::length($min, null)
#### v::length(null, $max)
#### v::length($min, $max, boolean $inclusive=false)

Validates lengths. Most simple example:

    v::string()->length(1, 5)->validate('abc'); //true

You can also validate only minimum length:

    v::string()->length(5, null)->validate('abcdef'); // true

Only maximum length:

    v::string()->length(null, 5)->validate('abc'); // true

The type as the first validator in a chain is a good practice,
since length accepts many types:

    v::arr()->length(1, 5)->validate(array('foo', 'bar')); //true

A third parameter may be passed to validate the passed values inclusive:

    v::string()->length(1, 5, true)->validate('a'); //true

Message template for this validator includes `{{minValue}}` and `{{maxValue}}`.

See also:

  * v::between() - Validates ranges

#### v::lowercase()

Validates if string characters are lowercase in the input:

    v::string()->lowercase()->validate('xkcd'); //true

See also:

  * v::uppercase()

#### v::macAddress()

Validates a Mac Address.

    v::macAddress()->validate('00:11:22:33:44:55'); //true

#### v::max()
#### v::max(boolean $inclusive=false)

Validates if the input doesn't exceed the maximum value.

    v::int()->max(15)->validate(20); //false

Also accepts dates:

    v::date()->max('2012-01-01')->validate('2010-01-01'); //true

`true` may be passed as a parameter to indicate that inclusive
values must be used.

Message template for this validator includes `{{maxValue}}`.

See also:

  * v::min()
  * v::between()

#### v::min()
#### v::min(boolean $inclusive=false)

Validates if the input doesn't exceed the minimum value.

    v::int()->min(15)->validate(5); //false

Also accepts dates:

    v::date()->min('2012-01-01')->validate('2015-01-01'); //true

`true` may be passed as a parameter to indicate that inclusive
values must be used.

Message template for this validator includes `{{minValue}}`.

See also:

  * v::max()
  * v::between()

#### v::minimumAge($age)

Validates a minimum age for a given date.

    v::date()->minimumAge(18)->validate('1987-01-01'); //true

Using `date()` before is a best-practice.

Message template for this validator includes `{{age}}`.

See also:

  * v::date()

#### v::multiple($multipleOf)

Validates if the input is a multiple of the given parameter

    v::int()->multiple(3)->validate(9); //true

See also:

  * v::primeNumber()

#### v::negative()

Validates if a number is lower than zero

    v::numeric()->negative()->validate(-15); //true

See also:

  * v::positive()

#### v::noWhitespace()

Validates if a string contains no whitespace (spaces, tabs and line breaks);

    v::noWhitespace()->validate('foo bar');  //false
    v::noWhitespace()->validate("foo\nbar"); //false

Like other rules the input is still optional.

    v::string()->noWhitespace()->validate('');  //true
    v::string()->noWhitespace()->validate(' '); //false

This is most useful when chaining with other validators such as `v::alnum()`

#### v::noneOf($v1, $v2, $v3...)

Validates if NONE of the given validators validate:

    v::noneOf(
        v::int(),
        v::float()
    )->validate('foo'); //true

In the sample above, 'foo' isn't a integer nor a float, so noneOf returns true.

See also:

  * v::not()
  * v::allOf()
  * v::oneOf()

#### v::not(v $negatedValidator)

Negates any rule.

    v::not(v::ip())->validate('foo'); //true

using a shortcut

    v::ip()->not()->validate('foo'); //true

In the sample above, validator returns true because 'foo' isn't an IP Address.

You can negate complex, grouped or chained validators as well:

    v::not(v::int()->positive())->validate(-1.5); //true

using a shortcut

    v::int()->positive()->not()->validate(-1.5); //true

Each other validation has custom messages for negated rules.

See also:

  * v::noneOf()

#### v::notEmpty()

Validates if the given input is not empty or in other words is input mandatory and
required. This function also takes whitespace into account, use `noWhitespace()`
if no spaces or linebreaks and other whitespace anywhere in the input is desired.

    v::string()->notEmpty()->validate(''); //false

Null values are empty:

    v::notEmpty()->validate(null); //false

Numbers:

    v::int()->notEmpty()->validate(0); //false

Empty arrays:

    v::arr()->notEmpty()->validate(array()); //false

Whitespace:

    v::string()->notEmpty()->validate('        ');  //false
    v::string()->notEmpty()->validate("\t \n \r");  //false

See also:

  * v::noWhitespace()
  * v::nullValue()

#### v::nullValue()

Validates if the input is null. This rule does not allow empty strings to avoid ambiguity.

    v::nullValue()->validate(null); //true

See also:

  * v::notEmpty()

#### v::numeric()

Validates on any numeric value.

    v::numeric()->validate(-12); //true
    v::numeric()->validate('135.0'); //true

See also:

  * v::int()
  * v::digit()

#### v::object()

Validates if the input is an object.

    v::object()->validate(new stdClass); //true

See also:

  * v::instance()
  * v::attribute()

#### v::odd()

Validates an odd number.

    v::int()->odd()->validate(3); //true

Using `int()` before `odd()` is a best practice.

See also

  * v::even()
  * v::multiple()

#### v::oneOf($v1, $v2, $v3...)

This is a group validator that acts as an OR operator.

    v::oneOf(
        v::int(),
        v::float()
    )->validate(15.5); //true

In the sample above, `v::int()` doesn't validates, but
`v::float()` validates, so oneOf returns true.

`v::oneOf` returns true if at least one inner validator
passes.

Using a shortcut

    v::int()->addOr(v::float())->validate(15.5); //true

See also:

  * v::allOf()  - Similar to oneOf, but act as an AND operator
  * v::noneOf() - Validates if NONE of the inner rules validates
  * v::when()   - A ternary validator

#### v::perfectSquare()

Validates a perfect square.

    v::perfectSquare()->validate(25); //true (5*5)
    v::perfectSquare()->validate(9); //true (3*3)

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

    v::numeric()->positive()->validate(-15); //false

See also:

  * v::negative()

#### v::primeNumber()

Validates a prime number

    v::primeNumber()->validate(7); //true

#### v::prnt()
#### v::prnt(string $additionalChars)

Similar to `v::graph` but accepts whitespace.

    v::prnt()->validate('LMKA0$% _123'); //true

See also:

  * v::graph()

#### v::punct()
#### v::punct(string $additionalChars)

Accepts only punctuation characters:

    v::punct()->validate('&,.;[]'); //true

See also:

  * v::cntrl()
  * v::graph()
  * v::prnt()

#### v::readable()

Validates if the given data is a file exists and is readable.

    v::readable()->validate('/path/of/a/readable/file'); //true

#### v::regex($regex)

Evaluates a regex on the input and validates if matches

    v::regex('/[a-z]/')->validate('a'); //true

Message template for this validator includes `{{regex}}`

#### v::roman()

Validates roman numbers

    v::roman()->validate('IV'); //true

This validator ignores empty values, use `notEmpty()` when
appropriate.

#### v::sf($sfValidator)

Use Symfony2 validators inside Respect\Validation flow. Messages
are preserved.

    v::sf('Time')->validate('15:00:00');

You must add Symfony2 to your autoloading routines.

See also:

  * v::zend()

#### v::slug()

Validates slug-like strings:

    v::slug()->validate('my-wordpress-title'); //true
    v::slug()->validate('my-wordpress--title'); //false
    v::slug()->validate('my-wordpress-title-'); //false

#### v::space()
#### v::space(string $additionalChars)

Accepts only whitespace:

    v::space()->validate('    '); //true

See also:

  * v::cntrl()

#### v::startsWith($value)
#### v::startsWith($value, boolean $identical=false)

This validator is similar to `v::contains()`, but validates
only if the value is at the end of the.

For strings:

    v::startsWith('lorem')->validate('lorem ipsum'); //true

For arrays:

    v::startsWith('lorem')->validate(array('lorem', 'ipsum')); //true

`true` may be passed as a parameter to indicate identical comparison
instead of equal.

Message template for this validator includes `{{startValue}}`.

See also:

  * v::endsWith()
  * v::contains()
  * v::in()

#### v::string()

Validates a string.

    v::string()->validate('hi'); //true

See also:

  * v::alnum()

#### v::symbolicLink()

Validates if the given data is a path of a valid symbolic link.

    v::symbolicLink()->validate('/path/of/valid/symbolic/link'); //true

#### v::tld()

Validates a top-level domain

    v::tld()->validate('com'); //true
    v::tld()->validate('ly'); //true
    v::tld()->validate('org'); //true

See also

 * v::domain() - Validates domain names
 * v::countryCode() - Validates ISO country codes

#### v::uploaded()

Validates if the given data is a file that was uploaded via HTTP POST.

    v::uploaded()->validate('/path/of/an/uploaded/file'); //true

#### v::uppercase()

Validates if string characters are uppercase in the input:

    v::string()->uppercase()->validate('W3C'); //true

See also:

  * v::lowercase()

#### v::version()

Validates version numbers using Semantic Versioning.

    v::version()->validate('1.0.0');

#### v::vowels() *(deprecated)*

Validates strings that contains only vowels. It's now deprecated, vowel should be used
instead.

See also:

  * v::vowel()


#### v::vowel()

Similar to `v::alnum()`. Validates strings that contains only vowels:

    v::vowel()->validate('aei'); //true

See also:

  * v::alnum()  - a-z0-9, empty or whitespace only
  * v::digit() - 0-9, empty or whitespace only
  * v::alpha()  - a-Z, empty or whitespace only
  * v::consonant()

#### v::when(v $if, v $then, v $else)

A ternary validator that accepts three parameters.

When the $if validates, returns validation for $then.
When the $if doesn't validate, returns validation for $else.

    v::when(v::int(), v::positive(), v::notEmpty())->validate($input);

In the sample above, if `$input` is an integer, then it must be positive.
If `$input` is not an integer, then it must not me empty.

See also:

  * v::allOf()
  * v::oneOf()
  * v::noneOf()

#### v::xdigit()

Accepts an hexadecimal number:

    v::xdigit()->validate('abc123'); //true

Notice, however, that it doesn't accept strings starting with 0x:

    v::xdigit()->validate('0x1f'); //false

See also:

  * v::digit()
  * v::alnum()

#### v::writable()

Validates if the given data is a file exists and is writable.

    v::writable()->validate('/path/of/a/writable/file'); //true

#### v::zend($zendValidator)

Use Zend validators inside Respect\Validation flow. Messages
are preserved.

    v::zend('Hostname')->validate('google.com');

You need to put Zend Framework in your autoload routines.

See also:

  * v::sf()

[PunnyCode]: http://en.wikipedia.org/wiki/Punycode "Wikipedia: Punnycode"
[IDNA]: http://en.wikipedia.org/wiki/Internationalized_domain_name#Internationalizing_Domain_Names_in_Applications "Wikipedia: Internationalized domain name"
