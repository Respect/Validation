# Concrete API

There are many micro-frameworks that rely on magic methods. We don't. In this
document we're gonna explore the Respect\Validation API without fluent interfaces
or magic methods. We'll use a traditional dependency injection approach.

```php
use Respect\Validation\Validator as v;

$usernameValidator = v::alnum()->noWhitespace()->length(1, 15);
$usernameValidator->isValid('alganet'); // true
```

If you `var_dump($usernameValidator)`, you'll see a composite of objects with
`Respect\Validation\Rules\Alnum`, `Respect\Validation\Rules\NoWhitespace` and
`Respect\Validation\Rules\Length`. There is a specific object for each rule, and
the chain only builds the structure. You can build it by yourself:

```php
use Respect\Validation\Rules;

$usernameValidator = new Rules\AllOf(
    new Rules\Alnum(),
    new Rules\NoWhitespace(),
    new Rules\Length(1, 15)
);
$usernameValidator->isValid('alganet'); // true
```

This is still a very lean API. You can use it in any dependency injection
container or test it in the way you want. Nesting is still possible:

```php
use Respect\Validation\Rules;

$usernameValidator = new Rules\AllOf(
    new Rules\Alnum(),
    new Rules\NoWhitespace(),
    new Rules\Length(1, 15)
);
$userValidator = new Rules\Key('name', $usernameValidator);
$userValidator->isValid(['name' => 'alganet']); // true
```

## New in Version 3.0

Version 3.0 introduces several new features and changes to the API:

### Assert Method Changes

The `assert()` and `check()` methods are now only available on the `Validator` wrapper, not on individual rule classes:

```php
// v2.x pattern (no longer works)
// $email = new Email();
// $email->assert($input);

// v3.0 pattern
v::email()->assert($input);
// OR
$validator = new Validator(new Email());
$validator->assert($input);
```

### New Assert Overloads

Version 3.0 introduces flexible `assert()` overloads that accept templates, exceptions, and callables:

```php
use Respect\Validation\Validator as v;

// Template string
v::email()->assert($input, 'Must be a valid email');

// Template array (per rule)
v::intVal()->positive()->lessThan(100)->assert($input, [
    'intVal' => 'Must be an integer',
    'positive' => 'Must be positive',
    'lessThan' => 'Must be under 100',
]);

// Custom exception
v::email()->assert($input, new DomainException('Invalid email'));

// Callable handler
v::email()->assert($input, fn($ex) => logError($ex));
```

### Named and Templated Rules

Version 3.0 introduces `Named` and `Templated` rules for clearer message customization:

```php
use Respect\Validation\Validator as v;

// Named rule for better identification
$validator = v::named(v::alnum()->lowercase(), 'Username');

// Templated rule for custom message
$validator = v::templated(
    v::named(v::alnum()->lowercase(), 'Username'),
    '{{name}} must be a valid username'
);

// Combined approach
$validator = v::templated(
    v::named(v::email(), 'Email Address'),
    '{{name}} is invalid'
);
```

### Prefix Rules

For common validation patterns, use the concise prefix rule syntax:

```php
use Respect\Validation\Validator as v;

// Traditional chaining
v::key('email', v::email());
v::property('age', v::positive());

// Prefix rules (v3.0+)
v::keyEmail('email');
v::propertyPositive('age');

// Available prefixes: key, property, length, max, min, nullOr, undefOr
```

### Attributes Support

PHP 8+ attributes allow you to declare validation rules directly on class properties:

```php
use Respect\Validation\Rules\{Email, Between, NotBlank};

class User
{
    #[Email]
    public string $email;
    
    #[Between(18, 120)]
    public int $age;
    
    #[NotBlank]
    public string $name;
}

// Validate all attributed properties
v::attributes()->assert($user);
```

## How It Works?

The Respect\Validation chain is an
[internal DSL](http://martinfowler.com/bliki/InternalDslStyle.html).
It acts in the creational realm of objects (where Abstract Factories and Builders
live), and it's only job is to make rule construction terse and fluent.

## FAQ

> Is `v` in `v::something` a class name?

No! The class is `Respect\Validation\Validator`, we suggest `v` as a very short alias.

> Is `v::something()` a static call?

Yes. Just like the default `DateTime::createFromFormat()` or
`Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration()`. It builds
something complex and returns for you.

> I really don't like static calls, can I avoid it?

Yes. Just use `$validator = new Validator();` each time you want a new validator,
and continue from there.

> Do you have a static method for each rule?

No. We use `__callStatic()`.

> Magic methods are slow! Why do you use them?

They're optional. If you use the `new` interface, they won't be called.

(still, do some benchmarks, you'd be surprised with our implementation).
