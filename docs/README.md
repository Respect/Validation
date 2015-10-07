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

On oldest versions of Respect\Validation all validators treat input as optional
and accept an empty string input as valid. Even though a useful feature that
caused a lot of troubles for our team and neither was an obvious behavior. Also
there was some people who likes to accept `null` as optional value, not only an
empty string.

For that reason all rules are mandatory now but if you want to treat a value as
optional you can use `v::optional()` rule:

```php
v::alpha()->validate(''); // false input required
v::alpha()->validate(null); // false input required

v::optional(v::alpha())->validate(''); // true
v::optional(v::alpha())->validate(null); // true
```

By _optional_ you may interpret as `null` or an empty string (`''`).

See more on [Optional](Optional.md).

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

## Requesting Messages

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

## Getting Messages

Sometimes you just need all the messages, for that you can use `getMessages()`.
It will return all messages from the rules that did not pass the validation.

```php
try {
    Validator::key('username', Validator::length(2, 32))
             ->key('birthdate', Validator::date())
             ->key('password', Validator::notEmpty())
             ->key('email', Validator::email())
             ->assert($input);
} catch (NestedValidationExceptionInterface $e) {
    print_r($e->getMessages());
}
```

The code above may display something like:

```
Array
(
    [0] => username must have a length between 2 and 32
    [1] => birthdate must be a valid date
    [2] => password must not be empty
    [3] => Key email must be present
)
```

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

## Message localization

You're also able to translate your message to another language with Validation.
The only thing one must do is to define the param `translator` as a callable that
will handle the translation:

```php
$exception->setParam('translator', 'gettext');
```

The example above uses `gettext()` but you can use any other callable value, like
`array($translator, 'trans')` or `you_custom_function()`.

After that, if you call `getMainMessage()` or `getFullMessage()` (for nested),
the message will be translated.

Note that `getMessage()` will keep the original message.

## Custom Rules

You also can use your own rules:

```php
namespace My\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class MyRule extends AbstractRule
{
    public function validate($input)
    {
        // Do something here with the $input and return a boolean value
    }
}
```

If you do want Validation to execute you rule (or rules) in the chain, you must
use `v::with()` passing your rule's namespace as an argument:

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
- [Changelog](../CHANGELOG.md)
