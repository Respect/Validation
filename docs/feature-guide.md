<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Feature Guide

The `ValidatorBuilder` class is the core of Respect\Validation, offering a fluent interface for building validators.

For convenience, the `ValidatorBuilder` class is aliased as `v`. This means you can write `v::intType()` instead of `\Respect\Validation\ValidatorBuilder::intType()`.

## Validation methods

### Validating using booleans

With the `isValid()` method, determine if your input meets a specific validator.

```php
if (!v::intType()->positive()->isValid($input)) {
    echo 'The input you gave me is not a positive integer';
}
```

Note that you can combine multiple validators for a complex validation.

### Validating using exceptions

The `assert()` method throws an exception when validation fails. You can handle those exceptions with `try/catch` for more robust error handling.

```php
v::intType()->positive()->assert($input);
```

### Validating using results

You can validate data and handle the result manually without using exceptions:

```php
$result = v::numericVal()->positive()->between(1, 255)->validate($input);
if ($result->hasFailed()) {
    echo $result;
}
```

The `validate()` method returns a `ResultQuery` object that has the following methods to output messages:

 - `getMessage()`: Returns the first message from the deepest failed result in chain.
 - `getFullMessage()`: Returns the full message including all failed results.
 - `getMessages()`: Returns an array of all messages from failed results.

## Smart validation

Respect\Validation offers over 150 validators, many of which are designed to address common scenarios.

### PHP attributes

PHP attributes are supported, allowing you to use any validator as an attribute:

```php
use Respect\Validation\Validators as Validator;
use Respect\Validation\Rules\GreaterThan;

final readonly class User
{
    public function __construct(
        #[Validator\Email]
        public string $email,
        #[Validator\Between(18, 120)]
        public int $age,
        #[Validator\Length(new GreaterThan(1))]
        public string $name,
    ) {
    }
}

// Validate everything at once
v::attributes()->assert($user);
```

### Result composition

Validators can wrap others and combine their results into a single, coherent message. The outer validator provides context (what was extracted), and the inner validator provides the validation (what was expected).

```php
v::all(v::intType())->assert(['1', '2', '3']);
// → Every item in `["1", "2", "3"]` must be an integer

v::length(v::greaterThan(3))->assert('abc');
// → The length of "abc" must be greater than 3

v::min(v::positive())->assert([3, 1, 0, -5]);
// → The minimum of `[3, 1, 0, -5]` must be a positive number

v::max(v::positive())->assert([-1, -2, -3]);
// → The maximum of `[-1, -2, -3]` must be a positive number

v::size('MB', v::not(v::greaterThan(5)))->assert('path/to/file.zip');
// → The size in megabytes of "path/to/file.zip" must not be greater than 5

v::dateTimeDiff('years', v::greaterThan(18))->assert('2025');
// → The number of years between now and "2025" must be greater than 18
```

### Prefixed shortcuts

For convenience, several prefixed shortcuts are available for validators that wrap other validators:

```php
v::allEmoji()->assert($input);              // all items must be emojis
v::keyEmail('email')->assert($input);       // key 'email' must be valid email
v::propertyPositive('age')->assert($input); // property 'age' must be positive
v::lengthBetween(5, 10)->assert($input);    // length between 5 and 10
v::maxLessThan(100)->assert($input);        // max value less than 100
v::minGreaterThan(0)->assert($input);       // min value greater than 0
v::nullOrEmail()->assert($input);           // null or valid email
v::undefOrPositive()->assert($input);       // undefined or positive number
```

See [Prefixes](prefixes.md) for more information.

### Other validation types

Beyond the examples above, Respect\Validation provides specialized validators for common patterns:

- **Arrays**: Access and validate array keys with [Key](validators/Key.md), [KeyOptional](validators/KeyOptional.md), [KeyExists](validators/KeyExists.md).
- **Array structures**: Enforce exact key schemas with [KeySet](validators/KeySet.md).
- **Object properties**: Validate object state with [Property](validators/Property.md), [PropertyOptional](validators/PropertyOptional.md), [PropertyExists](validators/PropertyExists.md).
- **Conditional validation**: Handle nullable or optional values with [NullOr](validators/NullOr.md), [UndefOr](validators/UndefOr.md), [When](validators/When.md).
- **Grouped validation**: Combine validators with AND/OR logic using [AllOf](validators/AllOf.md), [AnyOf](validators/AnyOf.md), [NoneOf](validators/NoneOf.md), [OneOf](validators/OneOf.md).
- **Iteration**: Validate every item in a collection with [Each](validators/Each.md).
- **Length, Min, Max**: Validate derived values with [Length](validators/Length.md), [Min](validators/Min.md), [Max](validators/Max.md).
- **Special cases**: Handle dynamic rules with [Lazy](validators/Lazy.md), short-circuit on first failure with [Circuit](validators/Circuit.md), or transform input before validation with [Call](validators/Call.md).

## Customizing error messages

Respect\Validation provides several ways to customize error messages to better fit your application's needs.

### Using custom templates

Define your own error message when the validation fails:

```php
v::between(1, 256)->assert($input, '{{subject}} is not what I was expecting');
```

### Custom templates per validator

Provide unique messages for each validator in a chain:

```php
v::alnum()->lowercase()->assert($input, [
    'alnum' => 'Your username must contain only letters and digits',
    'lowercase' => 'Your username must be lowercase',
]);
```

### Custom templates for nested structures

When using validators that handle structures (like `Key` and `Property`), you can define the template by the path of the validator:

```php
// Target nested structures by path
v::key('name', v::stringType())
    ->key('age', v::intVal())
    ->assert($input, [
        '__root__' => 'Please check your user data',
        'name' => 'Please provide a valid name',
        'age' => 'Age must be a number',
    ]);
```

The `__root__` key targets the root validator. In this case, that's an `AllOf` that wraps the chain.

### Attaching templates to the chain

For reusable templates, you can attach them directly to the chain using the `Templated` validator:

```php
v::templated('This is my template', v::email())->assert($input);
// → This is my template
```

The `Templated` validator also allows you to pass parameters to your template, so you can inject your own placeholders.

### Placeholder pipes

Placeholder pipes allow you to customize how values are rendered in error message templates by adding a pipe (`|`) followed by a modifier name to your placeholder.

```php
v::templated(
    'The {{field|raw}} field is required',
    v::notEmpty(),
    ['field' => 'email'],
)->assert('');
// → The email field is required
// (instead of: The "email" field is required)
```

For detailed information on all available placeholder pipes, see the [Placeholder Pipes documentation](messages/placeholder-pipes.md).

## Using your own exceptions

### Exception objects

Integrate your own exception objects when the validation fails:

```php
v::alnum()->assert($input, new DomainException('Not a valid username'));
```

### Exception objects via callable

Provide a callable that creates an exception object to be used when the validation fails:

```php
use Respect\Validation\ValidatorBuilder as v;
use Respect\Validation\Exceptions\ValidationException;

v::alnum()->lowercase()->assert(
    $input,
    fn(ValidationException $exception) => new DomainException('Username: '. $exception->getMessage())
);
```

## Naming validators

Template messages include the placeholder `{{subject}}`, which defaults to the input. Use the `named()` validator to replace it with a more descriptive label:

```php
v::named('Your email', v::email())->assert($input);
// → Your email must be a valid email
```

## Reusing validators

The `ValidatorBuilder` is immutable. Every time you add a new validator to the chain, you get a new instance while the original remains unchanged. This makes validators safe to create once and reuse:

```php
$validator = v::alnum()->lowercase();

$validator->assert('respect');
$validator->assert('validation');
$validator->assert('alexandre gaigalas');
```

Every time you add a new node to the chain, a new immutable instance is created. That means you can do things like:

```php
$baseValidator = v::intType()->between(1, 155);

$baseValidator->even()->assert($input1);

$baseValidator->odd()->assert($input2);
```

Both the `even()` and `odd()` calls created a new instance, which means that the `$baseValidator` remained unchanged.

## Advanced features

### Inverting validators

Use the `not` prefix to invert a validator:

```php
v::notEquals('main')->assert($input);
```

### Nested validation paths

Validation can trace the path of nested structures and display helpful messages. Use `v::init()` to start a chain without an implicit `AllOf` wrapper—this is useful when you want full control over how validators are grouped.

```php
$validator = v::init()
    ->key(
        'mysql',
        v::init()
            ->key('host', v::stringType())
            ->key('user', v::stringType())
            ->key('password', v::stringType())
            ->key('schema', v::stringType()),
    )
    ->key(
        'postgresql',
        v::init()
            ->key('host', v::stringType())
            ->key('user', v::stringType())
            ->key('password', v::stringType())
            ->key('schema', v::stringType()),
    )
    ->assert($input);
// → `.mysql.host` must be a string
```

Not only do you have the full path of the nested structure, but it's also clear that `.mysql.host` is a path, not a name.

The `ResultQuery` also has methods to query nested results:

```php
$result = $validator->validate($input);
$mysqlUserResult = $result->findByPath('mysql.user');
if ($mysqlUserResult !== null) {
    echo $mysqlUserResult;
}
```

The `findByPath()` returns either a `ResultQuery` or `null`, and you can also use `findByName()` and `findById()`.

### Helpful stack traces

When an exception is thrown, the stack trace points to your code, not library internals:

```text
Respect\Validation\Exceptions\ValidationException: "string" must be an integer in /opt/examples/file.php:11
Stack trace:
#0 /opt/examples/file.php(11): Respect\Validation\Validator->assert(1.0)
#1 {main}
```

Your file. Your line. Your problem to fix — not ours to hide.
