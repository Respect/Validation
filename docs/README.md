# Feature Guide

## Namespace Import

Respect\Validation is namespaced, but you can make your life easier by importing
a single class into your context:

```php
use Respect\Validation\Validator as v;
```

## Simple Validation

The Hello World validator is something like this:

```php
$number = 123;
v::numeric()->validate($number); //true
```

## Chained Validation

It is possible to use validators in a chain. Sample below validates a string
containing numbers and letters, no whitespace and length between 1 and 15.

```php
$usernameValidator = v::alnum()->noWhitespace()->length(1,15);
$usernameValidator->validate('alganet'); //true
```

## Validating Object Attributes

Given this simple object:

```php
$user = new stdClass;
$user->name = 'Alexandre';
$user->birthdate = '1987-07-01';
```

Is possible to validate its attributes in a single chain:

```php
$userValidator = v::attribute('name', v::string()->length(1,32))
                  ->attribute('birthdate', v::date()->age(18));

$userValidator->validate($user); //true
```

Validating array keys is also possible using `v::key()`

Note that we used `v::string()` and `v::date()` in the beginning of the validator.
Although is not mandatory, it is a good practice to use the type of the
validated object as the first node in the chain.

## Input optional

All validators treat input as optional and will accept empty string input as valid,
unless otherwise stated in the documentation.

We use the `v:notEmpty()` validator prefixed to disallow empty input and effectively
define the field as mandatory as input will be required or validation will fail.

```php
v::string()->notEmpty()->validate(''); //false input required
```

## Negating Rules

You can use the `v::not()` to negate any rule:

```php
v::not(v::int())->validate(10); //false, input must not be integer
```

## Validator Reuse

Once created, you can reuse your validator anywhere. Remember `$usernameValidator`?

```php
$usernameValidator->validate('respect');            //true
$usernameValidator->validate('alexandre gaigalas'); //false
$usernameValidator->validate('#$%');                //false
```

## Exception Types

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

## Informative Exceptions

When something goes wrong, Validation can tell you exactly what's going on. For this,
we use the `assert()` method instead of `validate()`:

```php
use Respect\Validation\Exceptions\NestedValidationExceptionInterface;

try {
    $usernameValidator->assert('really messed up screen#name');
} catch(NestedValidationExceptionInterface $exception) {
   echo $exception->getFullMessage();
}
```

The printed message is exactly this, as a text tree:

```no-highlight
\-All of the 3 required rules must pass
  |-"really messed up screen#name" must contain only letters (a-z) and digits (0-9)
  |-"really messed up screen#name" must not contain whitespace
  \-"really messed up screen#name" must have a length between 1 and 15
```

## Getting Messages

The text tree is fine, but unusable on a HTML form or something more custom. You can use
`findMessages()` for that:

```php
use Respect\Validation\Exceptions\NestedValidationExceptionInterface;

try {
    $usernameValidator->assert('really messed up screen#name');
} catch(NestedValidationExceptionInterface $exception) {
    var_dump($exception->findMessages(array('alnum', 'length', 'noWhitespace')));
}
```

`findMessages()` returns an array with messages from the requested validators.

## Custom Messages

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

## Custom Rules

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

## Validator Name

On `v::attribute()` and `v::key()`, `{{name}}` is the attribute/key name. For others,
is the same as the input. You can customize a validator name using:

```php
v::date('Y-m-d')->between('1980-02-02', 'now')->setName('Member Since');
```

## Zend/Symfony Validators

It is also possible to reuse validators from other frameworks if they are installed:

```php
$hostnameValidator = v::zend('Hostname')->assert('google.com');
$timeValidator     = v::sf('Time')->assert('22:00:01');
```

## Validation Methods

We've seen `validate()` that returns true or false and `assert()` that throws a complete
validation report. There is also a `check()` method that returns an Exception
only with the first error found:

```php
use Respect\Validation\Exceptions\ValidationExceptionInterface;

try {
    $usernameValidator->check('really messed up screen#name');
} catch(ValidationExceptionInterface $exception) {
    echo $exception->getMainMessage();
}
```

Message:

```no-highlight
"really messed up screen#name" must contain only letters (a-z) and digits (0-9)
```

***

See also:

- [Contributing](../CONTRIBUTING.md)
- [Installation](INSTALL.md)
- [License](../LICENSE.md)
- [Validators](VALIDATORS.md)
