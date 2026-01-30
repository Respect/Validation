<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Migrating from v2.x to v3.x

This guide will help you migrate your code from Respect\Validation 2.x to 3.0.

Version 3.0 is a major release with breaking changes. This document is organized into two main sections: **Breaking Changes** (what you must update) and **New Features** (what you can now use).

### Installation

Update your `composer.json` to require version 3.0:

```shell
composer require respect/validation:^3.0
```

Respect\Validation 3.0 requires PHP 8.5 or above (2.x required PHP 8.1+).

---

## Breaking changes

### Class and namespace changes

#### Main class rename

The main `Validator` class has been renamed to `ValidatorBuilder`:

```diff
- use Respect\Validation\Validator as v;
+ use Respect\Validation\ValidatorBuilder as v;
```

Alternatively, `v` is now a global class alias, so you can use it directly without any import:

```diff
- use Respect\Validation\Validator as v;

v::intType()->assert($input);
```

#### Internal terminology

Throughout the codebase, "rules" have been renamed to "validators":

| 2.x                                  | 3.0                                       |
| ------------------------------------ | ----------------------------------------- |
| `Respect\Validation\Rules` namespace | `Respect\Validation\Validators` namespace |
| `Rule` interface                     | `Validator` interface                     |
| `AbstractRule` class                 | Base classes in `Validators\Core`         |
| `Factory` class                      | `ValidatorFactory` class                  |
| `InvalidRuleConstructorException`    | `InvalidValidatorException`               |

### Validation methods

#### `validate()` now returns an object

In 2.x, `validate()` returned a boolean. In 3.0, it returns a `ResultQuery` object:

```diff
- if (v::intType()->validate($input)) {
+ if (v::intType()->isValid($input)) {
      // validation passed
  }
```

#### `check()` removed, `assert()` unified

In 2.x, there were two exception-based methods:

- `check()` threw rule-specific exceptions (e.g., `IntTypeException`)
- `assert()` threw `NestedValidationException`

In 3.0, both are unified into `assert()`, which throws `ValidationException`:

```diff
-use Respect\Validation\Exceptions\IntTypeException;
+use Respect\Validation\Exceptions\ValidationException;

try {
-	v::intType()->check($input);
-} catch (IntTypeException $exception) {
+	v::intType()->assert($input);
+} catch (ValidationException $exception) {
    echo $exception->getMessage();
}
```

The `ValidationException` provides all methods previously split between exceptions:

```diff
-use Respect\Validation\Exceptions\NestedValidationException;
+use Respect\Validation\Exceptions\ValidationException;

try {
    v::intType()->positive()->assert($input);
-} catch (NestedValidationException $exception) {
+} catch (ValidationException $exception) {
    $exception->getMessage();       // First error message
    $exception->getFullMessage();   // Full error tree
    $exception->getMessages();      // All errors as array
}
```

### Validator changes

#### Removed validators

##### `Type`

The `type()` validator has been replaced in favor of specific type validators:

```diff
- v::type('string')->assert($input);
+ v::stringType()->assert($input);

- v::type('int')->assert($input);
+ v::intType()->assert($input);

- v::type('array')->assert($input);
+ v::arrayType()->assert($input);
```

##### `Yes` and `No`

```diff
- v::yes()->assert('yes');
+ v::trueVal()->assert('yes');

- v::no()->assert('no');
+ v::falseVal()->assert('no');
```

##### `KeyNested`

```diff
- v::keyNested('user.profile.name', v::stringType())->assert($data);
+ v::key('user', v::key('profile', v::key('name', v::stringType())))->assert($data);
```

##### `Age`, `MinAge`, and `MaxAge`

These validators have been replaced by `DateTimeDiff`, which provides more flexibility by allowing you to specify the time unit and comparison validator:

```diff
- v::minAge(18)->assert($birthDate);
+ v::dateTimeDiff('years', v::greaterThanOrEqual(18))->assert($birthDate);

- v::maxAge(65)->assert($birthDate);
+ v::dateTimeDiff('years', v::lessThanOrEqual(65))->assert($birthDate);

- v::age(18, 65)->assert($birthDate);
+ v::dateTimeDiff('years', v::between(18, 65))->assert($birthDate);
```

##### `PrimeNumber`, `Fibonacci`, `PerfectSquare`

Combine `Callback` with a mathematical library of your choice:

```diff
- v::primeNumber()->assert(7);
+ v::callback(static fn ($input) => \MathPHP\NumberTheory\Integer::isPrime($input))->assert(7);
```

See: https://github.com/markrogoyski/math-php

##### `FilterVar`

Use `Callback` instead:

```diff
- v::filterVar(FILTER_VALIDATE_INT)->assert(123);
+ v::callback(static fn($input) => filter_var($input, FILTER_VALIDATE_INT) !== false)->assert(123);
```

##### `Uploaded`

Use `Callback` instead:

```diff
- v::uploaded()->assert($fileName);
+ v::callback('is_uploaded_file')->assert($fileName);
```

##### `VideoUrl`

We offer no recommendation for replacing this validator.

#### Behavior changes

##### `Attribute` replaced by `Property` variants

The `Attribute` validator has been replaced by three separate validators with different signatures.

| Validator          | Description                             |
| ------------------ | --------------------------------------- |
| `Property`         | Property must exist and pass validation |
| `PropertyOptional` | Validates only if property exists       |
| `PropertyExists`   | Only checks if property exists          |

```diff
  // Property must exist and be valid
- v::attribute('name', v::stringType())->assert($user);
+ v::property('name', v::stringType())->assert($user);

  // Property is optional (mandatory = false)
- v::attribute('age', v::intType(), false)->assert($user);
+ v::propertyOptional('age', v::intType())->assert($user);

  // Only check existence (no validator, mandatory = true)
- v::attribute('id')->assert($user);
+ v::propertyExists('id')->assert($user);
```

##### `Key` split into three validators

The `Key` validator has been split into three separate validators with different signatures.

| Validator     | Description                        |
| ------------- | ---------------------------------- |
| `Key`         | Key must exist and pass validation |
| `KeyOptional` | Validates only if key exists       |
| `KeyExists`   | Only checks if key exists          |

```diff
  // Key must exist and be valid
- v::key('email', v::email())->assert($data);
+ v::key('email', v::email())->assert($data);

  // Key is optional (mandatory = false)
- v::key('phone', v::phone(), false)->assert($data);
+ v::keyOptional('phone', v::phone())->assert($data);

  // Only check existence (no validator, mandatory = true)
- v::key('id')->assert($data);
+ v::keyExists('id')->assert($data);
```

##### `Length` signature changed

The `length()` validator no longer accepts scalar min/max arguments. Use the new composition syntax:

```diff
- v::length(5, 10)->assert($input);
+ v::length(v::between(5, 10))->assert($input);

- v::length(5, null)->assert($input);
+ v::length(v::greaterThanOrEqual(5))->assert($input);

- v::length(null, 10)->assert($input);
+ v::length(v::lessThanOrEqual(10))->assert($input);
```

Or use the prefixed shortcuts:

```php
v::lengthBetween(5, 10)->assert($input);
v::lengthGreaterThanOrEqual(5)->assert($input);
v::lengthLessThanOrEqual(10)->assert($input);
```

##### `Size` signature changed

The `size()` validator no longer accepts string sizes like `'5MB'`. Use the new composition syntax:

```diff
- v::size('5MB', '10MB')->assert($file);
+ v::size('MB', v::between(5, 10))->assert($file);

- v::size('5MB', null)->assert($file);
+ v::size('MB', v::greaterThanOrEqual(5))->assert($file);

- v::size(null, '10MB')->assert($file);
+ v::size('MB', v::lessThanOrEqual(10))->assert($file);
```

##### `Each` validator stricter

The `Each` validator now rejects `stdClass`, non-iterable values, and empty iterables:

```php
// These now fail in 3.0
v::each(v::alwaysValid())->isValid(new stdClass()); // false
v::each(v::alwaysValid())->isValid([]);             // false (empty)
```

##### Composite validators require two or more validators

`AllOf`, `AnyOf`, `NoneOf`, and `OneOf` now require at least two validators:

```diff
- v::allOf(v::intType())->assert($input);
+ v::intType()->assert($input);
```

##### New package dependencies

Some validators now require additional packages:

| Validators                                                       | Required packages                                     |
| ---------------------------------------------------------------- | ----------------------------------------------------- |
| `CountryCode`, `LanguageCode`, `SubdivisionCode`, `CurrencyCode` | `sokil/php-isocodes` and `sokil/php-isocodes-db-only` |
| `Uuid`                                                           | `ramsey/uuid`                                         |

Install with:

```shell
composer require sokil/php-isocodes sokil/php-isocodes-db-only
composer require ramsey/uuid
```

#### Renamed validators

| 2.x        | 3.0                  | Notes                                     |
| ---------- | -------------------- | ----------------------------------------- |
| `Min`      | `GreaterThanOrEqual` | Clearer comparison semantics              |
| `Max`      | `LessThanOrEqual`    | Clearer comparison semantics              |
| `Nullable` | `NullOr`             | Consistent naming pattern                 |
| `Optional` | `UndefOr`            | Validates if value is undefined or passes |
| `KeyValue` | `Lazy`               | Deferred validator creation               |

```diff
- v::min(18)->assert($age);
+ v::greaterThanOrEqual(18)->assert($age);

- v::max(100)->assert($age);
+ v::lessThanOrEqual(100)->assert($age);

- v::nullable(v::email())->assert($email);
+ v::nullOr(v::email())->assert($email);

- v::optional(v::email())->assert($email);
+ v::undefOr(v::email())->assert($email);
```

Note: In 3.0, `Min` and `Max` validators exist but have different semantics — they extract the minimum/maximum value from a collection and validate it (see [Result composition](#result-composition)).

##### `NotBlank` logic inverted

In 2.x, `NotBlank` validated that a value was not blank. In 3.0, `Blank` validates that a value is blank, so you need to negate it:

```diff
- v::notBlank()->assert($input);
+ v::not(v::blank())->assert($input);
```

Or use the prefixed shortcut (see [New Features](#prefixed-shortcuts)):

```php
v::notBlank()->assert($input);
```

##### `NotEmpty` renamed to `Falsy`

The `NotEmpty` validator was renamed to `Falsy` with inverted logic:

```diff
- v::notEmpty()->assert($input);
+ v::not(v::falsy())->assert($input);
```

Or use the prefixed shortcut:

```php
v::notFalsy()->assert($input);
```

##### `NoWhitespace` renamed to `Spaced`

The `NoWhitespace` validator was renamed to `Spaced` with inverted logic. `Spaced` validates that a string **contains** whitespace:

```diff
- v::noWhitespace()->assert($input);
+ v::not(v::spaced())->assert($input);
```

Or use the prefixed shortcut:

```php
v::notSpaced()->assert($input);
```

##### `IterableType` renamed to `IterableVal`

```diff
- v::iterableType()->assert($input);
+ v::iterableVal()->assert($input);
```

Note: `IterableType` still exists in 3.0 but now strictly uses PHP's `is_iterable()` function (rejecting `stdClass`).

### Custom message methods removed

#### `setTemplate()` removed

```diff
- v::intType()->setTemplate('Please provide an integer')->check($input);
+ v::templated('Please provide an integer', v::intType())->assert($input);
```

#### `setName()` removed

```diff
- v::intType()->setName('User ID')->check($input);
+ v::named('User ID', v::intType())->assert($input);
```

### `{{name}}` placeholder renamed

The main placeholder in message templates has been renamed from `{{name}}` to `{{subject}}`:

```diff
- {{name}} must be valid
+ {{subject}} must be valid
```

The value of `{{subject}}` is determined by context:

| Context                      | Value                 | Example                                      |
| ---------------------------- | --------------------- | -------------------------------------------- |
| Key/Property/Each validators | The path              | `` `.email` must be valid ``                 |
| `Named` validator            | The custom name       | `Email must be valid`                        |
| Both path and name defined   | Path with name suffix | `` `.email` (<- User Email) must be valid `` |
| No path or name              | The input value       | `"invalid#email" must be valid`              |

### Factory and container changes

The `Factory` class has been replaced by a dependency injection container approach using `ContainerRegistry`:

```diff
- use Respect\Validation\Factory;
+ use Respect\Validation\ContainerRegistry;
+ use Symfony\Contracts\Translation\TranslatorInterface;

- Factory::setDefaultInstance(
-     (new Factory())
-         ->withRuleNamespace('My\\Validation\\Rules')
-         ->withTranslator($translator)
- );
+ $container = ContainerRegistry::createContainer([
+     // Add custom validator namespaces
+     'respect.validation.rule_factory.namespaces' => [
+         'My\\Validation\\Validators',
+         'Respect\\Validation\\Validators', // Keep the default namespace
+     ],
+     // Add a translator
+     TranslatorInterface::class => $translator,
+ ]);
+ ContainerRegistry::setContainer($container);
```

The `ContainerRegistry::createContainer()` returns a [PHP-DI](https://php-di.org/) container. You can also use any PSR-11 compatible container with `ContainerRegistry::setContainer()`.

### Custom validators

In 2.x, custom validators required a separate exception class to define error message templates. In 3.0, templates are defined using PHP attributes directly on the validator class.

**Before (2.x):** Two files required - validator and exception:

```php
// CustomException.php
use Respect\Validation\Exceptions\ValidationException;

final class CustomException extends ValidationException
{
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be custom',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be custom',
        ],
    ];
}

// Custom.php
use Respect\Validation\Rules\AbstractRule;

final class Custom extends AbstractRule
{
    public function validate($input): bool
    {
        return $this->checkSomething($input);
    }

    // Implementation of checkSomething()...
}
```

**After (3.0):** Single file with `#[Template]` attribute:

```php
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

#[Template(
    '{{subject}} must be custom',
    '{{subject}} must not be custom',
)]
final class Custom implements Validator
{
    public function evaluate(mixed $input): Result
    {
        return Result::of($this->checkSomething($input), $input, $this);
    }

    // Implementation of checkSomething()...
}
```

Base classes available in `Respect\Validation\Validators\Core`:

- `Simple` - For validators with simple boolean logic
- `Wrapper` - For validators that wrap another validator
- `Composite` - For validators that combine multiple validators
- `Envelope` - For validators that modify how another validator works

---

## New features

### New validators

Version 3.0 introduces several new validators:

| Validator          | Description                                                |
| ------------------ | ---------------------------------------------------------- |
| `All`              | Validates that every item in an iterable passes validation |
| `Attributes`       | Validates object properties using PHP attributes           |
| `BetweenExclusive` | Validates that a value is between two bounds (exclusive)   |
| `Circuit`          | Short-circuit validation, stops at first failure           |
| `ContainsCount`    | Validates the count of occurrences in a value              |
| `DateTimeDiff`     | Validates date/time differences (replaces Age validators)  |
| `Hetu`             | Validates Finnish personal identity codes (henkilötunnus)  |
| `KeyExists`        | Checks if an array key exists                              |
| `KeyOptional`      | Validates an array key only if it exists                   |
| `Lazy`             | Creates validators dynamically based on input              |
| `Named`            | Customizes the subject name in error messages              |
| `PropertyExists`   | Checks if an object property exists                        |
| `PropertyOptional` | Validates an object property only if it exists             |
| `Templated`        | Attaches custom error message templates                    |

#### All

Validates that every item in an iterable passes the given validator:

```php
v::all(v::intType())->assert([1, 2, 3]); // passes
v::all(v::positive())->assert([1, -2, 3]); // fails
```

#### Attributes

Validates object properties using PHP attributes defined on the class:

```php
use Respect\Validation\Validators as Validator;

final readonly class User
{
    public function __construct(
        #[Validator\Email]
        public string $email,

        #[Validator\Between(18, 120)]
        public int $age,

        #[Validator\Length(new Validator\Between(1, 100))]
        public string $name,
    ) {
    }
}

// Validate all properties at once
v::attributes()->assert($user);
```

#### BetweenExclusive

Validates that a value is between two bounds, excluding the bounds themselves:

```php
v::betweenExclusive(1, 10)->assert(5); // passes
v::betweenExclusive(1, 10)->assert(1); // fails (1 is not > 1)
v::betweenExclusive(1, 10)->assert(10); // fails (10 is not < 10)
```

#### Circuit

Validates input against a series of validators, stopping at the first failure. Useful for dependent validations:

```php
$validator = v::circuit(
    v::key('countryCode', v::countryCode()),
    v::lazy(
        fn($input) => v::key(
            'subdivisionCode',
            v::subdivisionCode($input['countryCode'])
        )
    ),
);

$validator->assert([]); // → `.countryCode` must be present
$validator->assert(['countryCode' => 'US']); // → `.subdivisionCode` must be present
$validator->assert(['countryCode' => 'US', 'subdivisionCode' => 'CA']); // passes
```

#### ContainsCount

Validates the count of occurrences of a value:

```php
v::containsCount('a', v::equals(3))->assert('banana'); // passes (3 'a's)
v::containsCount('x', v::greaterThan(0))->assert('example'); // passes
```

#### DateTimeDiff

Validates date/time differences. Replaces the removed `Age`, `MinAge`, and `MaxAge` validators:

```php
v::dateTimeDiff('years', v::greaterThanOrEqual(18))->assert('2000-01-01'); // passes if 18+ years ago
v::dateTimeDiff('days', v::lessThan(30))->assert('2024-01-15'); // passes if less than 30 days ago
```

#### Hetu

Validates Finnish personal identity codes (henkilötunnus):

```php
v::hetu()->assert('010101-123N'); // passes
```

#### KeyExists

Checks if an array key exists (without validating its value):

```php
v::keyExists('email')->assert(['email' => 'user@example.com']); // passes
v::keyExists('email')->assert(['name' => 'John']); // fails
```

#### KeyOptional

Validates an array key only if it exists:

```php
v::keyOptional('phone', v::phone())->assert(['name' => 'John']); // passes (key absent)
v::keyOptional('phone', v::phone())->assert(['phone' => '+1234567890']); // passes
v::keyOptional('phone', v::phone())->assert(['phone' => 'invalid']); // fails
```

#### Lazy

Creates validators dynamically based on the input, useful for cross-field validation:

```php
// Validate that 'confirmation' matches 'password'
v::lazy(
    fn($input) => v::key('confirmation', v::equals($input['password'] ?? null))
)->assert(['password' => 'secret', 'confirmation' => 'secret']); // passes
```

#### Named

Customizes the subject name in error messages:

```php
v::named('User ID', v::intType())->assert('abc');
// → User ID must be an integer
```

#### PropertyExists

Checks if an object property exists (without validating its value):

```php
v::propertyExists('name')->assert($user); // passes if $user->name exists
```

#### PropertyOptional

Validates an object property only if it exists:

```php
v::propertyOptional('nickname', v::stringType())->assert($user); // passes if absent
v::propertyOptional('nickname', v::stringType())->assert($user); // validates if present
```

#### Templated

Attaches custom error message templates to validators:

```php
v::templated('Please provide a valid number', v::intType())->assert('abc');
// → Please provide a valid number
```

### Result-based validation

The `validate()` method now returns a `ResultQuery` object that provides detailed error inspection:

```php
$result = v::numericVal()->positive()->between(1, 255)->validate($input);

$result->hasFailed();      // Check if the validation has failed (boolean)
$result->getMessage();     // Get the first error message
$result->getFullMessage(); // Get all error messages as a tree
$result->getMessages();    // Get all error messages as an array
```

#### Finding by path

Use `findByPath()` to locate validation results using dot notation for nested structures:

```php
$result = v::init()
    ->key('user', v::key('email', v::email()))
    ->key('items', v::each(v::positive()))
    ->validate([
        'user' => ['email' => 'invalid'],
        'items' => [10, -5, 20],
    ]);

echo $result->findByPath('user.email');
// → `.user.email` must be a valid email address

echo $result->findByPath('items.1');
// → `.items.1` must be a positive number
```

#### Finding by name

Use `findByName()` to locate validation results by the custom name set with the `Named` validator:

```php
$result = v::named('User Email', v::email())->validate('bad');

echo $result->findByName('User Email');
// → User Email must be a valid email address
```

#### Finding by ID

Use `findById()` to locate validation results by the validator's ID (e.g., `stringType`, `email`):

```php
$result = v::stringType()->email()->validate(123);

echo $result->findById('stringType');
// → 123 must be a string
```

All finder methods return either a `ResultQuery` instance or `null` if not found.

### Prefixed shortcuts

Version 3.0 introduces convenient prefixed shortcuts for common patterns:

```php
// Null-or validators
v::nullOrEmail()->assert(null);              // passes
v::nullOrEmail()->assert('user@example.com'); // passes

// Undefined-or validators
v::undefOrPositive()->assert(null);  // passes
v::undefOrPositive()->assert(5);     // passes

// All (array item) validators
v::allPositive()->assert([1, 2, 3]);        // passes
v::allEmail()->assert(['a@b.com', 'c@d.com']); // passes

// Key validators
v::keyEmail('email')->assert(['email' => 'user@example.com']); // passes

// Property validators
v::propertyPositive('age')->assert($user); // passes if $user->age is positive

// Length validators
v::lengthBetween(5, 10)->assert('hello'); // passes

// Min/Max validators
v::minGreaterThan(0)->assert([1, 2, 3]);  // passes
v::maxLessThan(10)->assert([1, 2, 3]);    // passes

// Negation prefix
v::notBlank()->assert('hello'); // passes
```

### Result composition

Validators compose results for clearer error messages:

```php
v::all(v::intType())->assert(['1', '2', '3']);
// → Every item in ["1", "2", "3"] must be an integer

v::length(v::greaterThan(3))->assert('abc');
// → The length of "abc" must be greater than 3

v::key('age', v::greaterThanOrEqual(18))->assert(['age' => 16]);
// → `.age` must be greater than or equal to 18
```

### Paths in error messages

Error messages now include full paths for nested structures:

```php
v::init()
    ->key('mysql', v::init()->key('host', v::stringType()))
    ->key('postgresql', v::init()->key('host', v::stringType()))
    ->assert($input);
// → `.mysql.host` must be a string
```

### Helpful stack traces

When validation fails, stack traces now point to your code instead of library internals.

**2.x:**

```text
Stack trace:
#0 /opt/vendor/respect/validation/library/Factory.php(233): ReflectionClass->newInstance(1.0, 'intVal', Array, Object(Respect\Validation\Message\Formatter))
#1 /opt/vendor/respect/validation/library/Factory.php(164): Respect\Validation\Factory->createValidationException('Respect\\Validat...', 'intVal', 1.0, Array, Object(Respect\Validation\Message\Formatter))
#2 /opt/vendor/respect/validation/library/Rules/AbstractRule.php(70): Respect\Validation\Factory->exception(Object(Respect\Validation\Rules\IntVal), 1.0, Array)
#3 /opt/vendor/respect/validation/library/Rules/AbstractRule.php(45): Respect\Validation\Rules\AbstractRule->reportError(1.0)
#4 /opt/vendor/respect/validation/library/Rules/AbstractRule.php(53): Respect\Validation\Rules\AbstractRule->assert(1.0)
#5 /opt/vendor/respect/validation/library/Rules/AllOf.php(50): Respect\Validation\Rules\AbstractRule->check(1.0)
#6 /opt/vendor/respect/validation/library/Validator.php(68): Respect\Validation\Rules\AllOf->check(1.0)
#7 /opt/example.php(11): Respect\Validation\Validator->check(1.0)
#8 {main}
```

**3.0:**

```text
Stack trace:
#0 /opt/example.php(11): Respect\Validation\Validator->assert(1.0)
#1 {main}
```

### Custom exceptions in assert()

Pass your own exception directly to `assert()`:

```php
v::email()->assert($input, new DomainException('Invalid email'));
```

Or use a callable to access the original exception message:

```php
v::email()->assert(
    $input,
    fn(ValidationException $e) => new DomainException($e->getMessage()),
);
```

### Placeholder pipes

Customize how values are rendered in templates using pipes:

```php
// `|raw` - removes quotes
v::templated(
    '{{subject|raw}} is not a UUID v{{version}}',
    v::uuid(1),
)->assert('eb3115e5-bd16-4939-ab12-2b95745a30f3');
// → eb3115e5-bd16-4939-ab12-2b95745a30f3 is not a UUID v1

// `|quote` - uses backticks
v::templated(
    'Value must match {{pattern|quote}}',
    v::regex('/^\d+$/'),
)->assert('abc');
// → Value must match `/^\d+$/`

// `|trans` - translates the value (when using a translator)
v::templated(
    'Le champ {{field|trans}} est invalide',
    v::email(),
    ['field' => 'email_address'],
)->assert('invalid');
// → Le champ "adresse e-mail" est invalide

// `|list:or` and `|list:and` - formats arrays as readable lists
v::templated(
    'Status must be {{haystack|list:or}}',
    v::in(['active', 'pending']),
)->assert('deleted');
// → Status must be "active" or "pending"
```

---

## Quick reference

```diff
  // Main class
- use Respect\Validation\Validator as v;
+ use Respect\Validation\ValidatorBuilder as v;

  // Boolean validation (unchanged)
  v::intType()->isValid($input);

  // Result-based validation
- v::intType()->validate($input);              // bool
+ v::intType()->isValid($input);               // bool

  // Exception-based validation
- v::intType()->check($input);   // IntTypeException
+ v::intType()->assert($input);  // ValidationException

- v::intType()->assert($input);  // NestedValidationException
+ v::intType()->assert($input);  // ValidationException

  // Renamed validators
- v::min(18);
+ v::greaterThanOrEqual(18);

- v::max(100);
+ v::lessThanOrEqual(100);

- v::nullable(v::email());
+ v::nullOr(v::email());

  // Attribute → Property
- v::attribute('name', v::stringType());
+ v::property('name', v::stringType());

- v::attribute('age', v::intType(), false);
+ v::propertyOptional('age', v::intType());

- v::attribute('id');
+ v::propertyExists('id');

  // Key changes
- v::key('phone', v::phone(), false);
+ v::keyOptional('phone', v::phone());

- v::key('id');
+ v::keyExists('id');

  // Removed validators
- v::keyNested('a.b.c', $validator);
+ v::key('a', v::key('b', v::key('c', $validator)));

- v::yes();
+ v::trueVal();

- v::no();
+ v::falseVal();

- v::minAge(18);
+ v::dateTimeDiff('years', v::greaterThanOrEqual(18));

- v::maxAge(65);
+ v::dateTimeDiff('years', v::lessThanOrEqual(65));
```

---

## Getting help

- Check the [Feature Guide](feature-guide.md) for detailed usage examples
- Browse the [List of Validators](validators.md) for validator-specific documentation
- Review the article [What's New in Respect\Validation 3.0](https://dev.to/henriquemoody/what-is-new-on-respectvalidation-30-37no)
- Open an issue on [GitHub](https://github.com/Respect/Validation/issues) if you find bugs or have questions
