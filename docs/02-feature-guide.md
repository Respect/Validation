# Feature Guide

The `ValidatorBuilder` class is the core of Respect\Validation, offering a fluent interface for building validators.

For convenience, the `ValidatorBuilder` class is aliased as `v`. This means you can write `v::intType()` instead of `\Respect\Validation\ValidatorBuilder::intType()`.

## Validating using booleans

With the `isValid()` method, determine if your input meets a specific validator.

```php
if (v::intType()->positive()->isValid($input)) {
    echo 'The input you gave me is a positive integer';
} else {
    echo 'The input you gave me is not a positive integer';
}
```

Note that you can combine multiple validators for a complex validation.

## Validating using exceptions

The `assert()` method throws an exception when validation fails. You can handle those exceptions with `try/catch` for more robust error handling.

### Basic example

```php
v::intType()->positive()->assert($input);
```

## Smart validation

Respect\Validation offers over 150 validators, many of which are designed to address common scenarios. Here's a quick guide to some specific use cases and the validators that make validation straightforward.

- Using validators as **PHP Attributes**: [Attributes](validators/Attributes.md).
- Validating **Arrays**: [Key](validators/Key.md), [KeyOptional](validators/KeyOptional.md), [KeyExists](validators/KeyExists.md).
- Validating **Array structures**: [KeySet](validators/KeySet.md).
- Validating **Object properties**: [Property](validators/Property.md), [PropertyOptional](validators/PropertyOptional.md), [PropertyExists](validators/PropertyExists.md).
- Using **Conditional validation**: [NullOr](validators/NullOr.md), [UndefOr](validators/UndefOr.md), [When](validators/When.md).
- Using **Grouped validation**: [AllOf](validators/AllOf.md), [AnyOf](validators/AnyOf.md), [NoneOf](validators/NoneOf.md), [OneOf](validators/OneOf.md)
- Validating **Each** value in the input: [Each](validators/Each.md).
- Validating the **Length** of the input: [Length](validators/Length.md).
- Validating the **Maximum** value in the input: [Max](validators/Max.md).
- Validating the **Minimum** value in the input: [Min](validators/Min.md).
- Handling **Special cases**: [Lazy](validators/Lazy.md), [Circuit](validators/Circuit.md), [Call](validators/Call.md).

### Custom templates

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

### Custom exception objects

Integrate your own exception objects when the validation fails:

```php
v::alnum()->assert($input, new DomainException('Not a valid username'));
```

### Custom exception objects via callable

Provide a callable that creates an exception object to be used when the validation fails:

```php
use Respect\Validation\ValidatorBuilder as v;
use Respect\Validation\Exceptions\ValidationException;

v::alnum()->lowercase()->assert(
    $input,
    fn(ValidationException $exception) => new DomainException('Username: '. $exception->getMessage()
);
```

## Inverting validators

Use the `not` prefix to invert a validator.

```php
v::notEquals('main')->assert($input);
```

For more details, check the [Not](validators/Not.md) validator documentation.

## Reusing validators

Validators can be created once and reused across multiple inputs.

```php
$validator = v::alnum()->lowercase();

$validator->assert('respect');
$validator->assert('validation');
$validator->assert('alexandre gaigalas');
```

## Customising validator names

Template messages include the placeholder `{{subject}}`, which defaults to the input. Use `setName()` to replace it with a more descriptive label.

```php
v::named('Age', v::dateTime('Y-m-d')->between('1980-02-02', 'now'))
    ->assert($input);
```
