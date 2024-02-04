# Feature Guide

## Namespace import

Respect\Validation is namespaced, but you can make your life easier by importing
a single class into your context:

```php
use Respect\Validation\Validator as v;
```

## Simple validation

The Hello World validator is something like this:

```php
$number = 123;
v::numericVal()->validate($number); // true
```

## Chained validation

It is possible to use validators in a chain. Sample below validates a string
containing numbers and letters, no whitespace and length between 1 and 15.

```php
$usernameValidator = v::alnum()->noWhitespace()->length(1, 15);
$usernameValidator->validate('alganet'); // true
```

## Validating object attributes

Given this simple object:

```php
$user = new stdClass;
$user->name = 'Alexandre';
$user->birthdate = '1987-07-01';
```

Is possible to validate its attributes in a single chain:

```php
$userValidator = v::attribute('name', v::stringType()->length(1, 32))
                  ->attribute('birthdate', v::date()->minAge(18));

$userValidator->validate($user); // true
```

Validating array keys is also possible using `v::key()`

Note that we used `v::stringType()` and `v::dateTime()` in the beginning of the validator.
Although is not mandatory, it is a good practice to use the type of the
validated object as the first node in the chain.

## Validating array keys and values

Validating array keys into another array is also possible using [Key](rules/Key.md).

If we got the array below:

```php
$data = [
    'parentKey' => [
        'field1' => 'value1',
        'field2' => 'value2'
        'field3' => true,
    ]
];
```

Using the next combination of rules, we can validate child keys.

```php
v::key(
    'parentKey',
    v::key('field1', v::stringType())
        ->key('field2', v::stringType())
        ->key('field3', v::boolType())
    )
    ->assert($data); // You can also use check() or validate()
```

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

By _optional_ we consider `null` or an empty string (`''`).

See more on [Optional](rules/Optional.md).

## Negating rules

You can use the `v::not()` to negate any rule:

```php
v::not(v::intVal())->validate(10); // false, input must not be integer
```

## Validator reuse

Once created, you can reuse your validator anywhere. Remember `$usernameValidator`?

```php
$usernameValidator->validate('respect');            //true
$usernameValidator->validate('alexandre gaigalas'); // false
$usernameValidator->validate('#$%');                //false
```

## Exception types

- `Respect\Validation\Exceptions\Exception`:
  - All exceptions implement this interface;
- `Respect\Validation\Exceptions\ValidationException`:
  - Implements the `Respect\Validation\Exceptions\Exception` interface
  - Thrown when the `check()` fails
  - All validation exceptions extend this class
  - Available methods:
    - `getMessage()`;
    - `updateMode($mode)`;
    - `updateTemplate($template)`;
- `Respect\Validation\Exceptions\NestedValidationException`:
  - Extends the `Respect\Validation\Exceptions\ValidationException` class
  - Usually thrown when the `assert()` fails
  - Available methods:
    - `getFullMessage()`;
    - `getMessages()`;

## Informative exceptions

When something goes wrong, Validation can tell you exactly what's going on. For this,
we use the `assert()` method instead of `validate()`:

```php
use Respect\Validation\Exceptions\NestedValidationException;

try {
    $usernameValidator->assert('really messed up screen#name');
} catch(NestedValidationException $exception) {
   echo $exception->getFullMessage();
}
```

The printed message is exactly this, as a nested Markdown list:

```no-highlight
- All of the required rules must pass for "really messed up screen#name"
  - "really messed up screen#name" must contain only letters (a-z) and digits (0-9)
  - "really messed up screen#name" must not contain whitespace
  - "really messed up screen#name" must have a length between 1 and 15
```

## Getting all messages as an array

If you want to get all the messages as an array you can use `getMessages()` for
that. The `getMessages()` method returns an array with all the messages.

```php
try {
    $usernameValidator->assert('really messed up screen#name');
} catch(NestedValidationException $exception) {
    print_r($exception->getMessages());
}
```

The `getMessages()` returns an array in which the keys are the name of the
validators, or its reference in case you are using [Key](rules/Key.md) or
[Attribute](rules/Attribute.md) rule:

```no-highlight
Array
(
    [alnum] => "really messed up screen#name" must contain only letters (a-z) and digits (0-9)
    [noWhitespace] => "really messed up screen#name" must not contain whitespace
    [length] => "really messed up screen#name" must have a length between 1 and 15
)
```

## Custom messages

Getting messages as an array is fine, but sometimes you need to customize them
in order to present them to the user. This is possible using the `getMessages()`
method as well by passing the templates as an argument:

```php
try {
    $usernameValidator->assert('really messed up screen#name');
} catch(NestedValidationException $exception) {
    print_r(
        $exception->getMessages([
            'alnum' => '{{name}} must contain only letters and digits',
            'noWhitespace' => '{{name}} cannot contain spaces',
            'length' => '{{name}} must not have more than 15 chars',
        ])
    );
}
```

For all messages, the `{{name}}` variable is available for templates. If you do
not define a name it uses the input to replace this placeholder.

The result of the code above will be:

```no-highlight
Array
(
    [alnum] => "really messed up screen#name" must contain only letters and digits
    [noWhitespace] => "really messed up screen#name" cannot contain spaces
    [length] => "really messed up screen#name" must not have more than 15 chars
)
```

Note that `getMessage()` will only return a message when the specific validation
in the chain fails.

## Validator name

On `v::attribute()` and `v::key()`, `{{name}}` is the attribute/key name. For others,
is the same as the input. You can customize a validator name using:

```php
v::dateTime('Y-m-d')->between('1980-02-02', 'now')->setName('Member Since');
```

## Validation methods

We've seen `validate()` that returns true or false and `assert()` that throws a complete
validation report. There is also a `check()` method that returns an Exception
only with the first error found:

```php
use Respect\Validation\Exceptions\ValidationException;

try {
    $usernameValidator->check('really messed up screen#name');
} catch(ValidationException $exception) {
    echo $exception->getMessage();
}
```

Message:

```no-highlight
"really messed up screen#name" must contain only letters (a-z) and digits (0-9)
```
