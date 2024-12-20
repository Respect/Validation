# Feature Guide

We'll use `v` as an alias for `Respect\Validation\Validator` to keep things simple:

```php
use Respect\Validation\Validator as v;
```

## Validating using booleans

With the `isValid()` method, determine if your input meets a specific validation rule.

```php
if (v::intType()->positive()->isValid($input)) {
    echo 'The input you gave me is a positive integer';
} else {
    echo 'The input you gave me is not a positive integer';
}
```

Note that you can combine multiple rules for a complex validation.
## Validating using exceptions

The `assert()` method throws an exception when validation fails. You can handle those exceptions with `try/catch` for more robust error handling.

### Basic example

```php
v::intType()->positive()->assert($input);
```

## Smart validation

Respect\Validation offers over 150 rules, many of which are designed to address common scenarios. Here’s a quick guide to some specific use cases and the rules that make validation straightforward.

* Using rules as **PHP Attributes**: [Attributes](rules/Attributes.md).
* Validating **Arrays**: [Key](rules/Key.md), [KeyOptional](rules/KeyOptional.md), [KeyExists](rules/KeyExists.md).
* Validating **Array structures**: [KeySet](rules/KeySet.md).
* Validating **Object properties**: [Property](rules/Property.md), [PropertyOptional](rules/PropertyOptional.md), [PropertyExists](rules/PropertyExists.md).
* Using **Conditional validation**: [NullOr](rules/NullOr.md), [UndefOr](rules/UndefOr.md), [When](rules/When.md).
* Using **Grouped validation**: [AllOf](rules/AllOf.md), [AnyOf](rules/AnyOf.md), [NoneOf](rules/NoneOf.md), [OneOf](rules/OneOf.md)
* Validating **Each** value in the input: [Each](rules/Each.md).
* Validating the **Length** of the input: [Length](rules/Length.md).
* Validating the **Maximum** value in the input: [Max](rules/Max.md).
* Validating the **Minimum** value in the input: [Min](rules/Min.md).
* Handling **Special cases**: [Lazy](rules/Lazy.md), [Circuit](rules/Circuit.md), [Call](rules/Call.md).

### Custom templates

Define your own error message when the validation fails:

```php
v::between(1, 256)->assert($input, '{{name}} is not what I was expecting');
```

### Custom templates per rule

Provide unique messages for each rule in a chain:

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
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ValidationException;

v::alnum()->lowercase()->assert(
    $input,
    fn(ValidationException $exception) => new DomainException('Username: '. $exception->getMessage()
);
```

## Inverting validation rules

Use the `not` prefix to invert a  validation rule.

```php
v::notEquals('main')->assert($input);
```

For more details, check the [Not](rules/Not.md) rule documentation.

## Reusing validators

Validators can be created once and reused across multiple inputs.

```php
$validator = v::alnum()->lowercase();

$validator->assert('respect');
$validator->assert('validation');
$validator->assert('alexandre gaigalas');
```

## Customising validator names

Template messages include the placeholder `{{name}}`, which defaults to the input. Use `setName()` to replace it with a more descriptive label.

```php
v::dateTime('Y-m-d')
    ->between('1980-02-02', 'now')
    ->setName('Age')
    ->assert($input);
```
