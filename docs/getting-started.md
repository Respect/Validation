---
weight: -100
---

# Getting Started

Welcome to Respect\Validation!

This guide will help you get up and running with the library quickly.

## Installation

To install Respect\Validation, use [Composer](http://getcomposer.org):

```shell
composer require respect/validation:^3.0
```

Ensure you have PHP 8.5 or above installed.

## Basic usage

The `ValidatorBuilder` (aliased as `v` for convenience) provides a fluent interface for building validators and running them.

### Validating using exceptions

The `assert()` method throws an exception when validation fails. Handle these exceptions with `try/catch` for robust error handling:

```php
try {
    v::intType()->assert($input);
} catch (Throwable $exception) {
    echo 'Validation failed: ' . $exception->getMessage();
}
```

### Validating without exceptions

The `validate()` method returns a `ResultQuery` object that allows you to inspect and display validation results:

```php
$result = v::intType()->validate($input);
if (!$result->isValid()) {
    echo 'Validation failed: ' . $result->getMessage();
}
```

### Validating using booleans

Use the `isValid()` method to check if your input meets specific validation criteria:

```php
if (!v::intType()->isValid($input)) {
    echo 'The input you gave me is not an integer';
}
```

## Key Features

### Complex validation

Combine multiple validators for complex validation rules:

```php
v::numericVal()->positive()->between(1, 255)->assert($input);
```

### Custom error messages

Define your own error messages when validation fails:

```php
v::between(1, 256)->assert($input, '{{subject}} is not what I was expecting');
```

### Custom exceptions

Throw your own exceptions when the validation fails:

```php
try {
    v::between(1, 256)->assert($input, new DomainException('Not within the expected range'));
} catch (DomainException $exception) {
    echo 'Custom exception caught: ' . $exception->getMessage();
}
```

### Reusing validators

Create validators once and reuse them across multiple inputs:

```php
$validator = v::alnum()->lowercase();

$validator->assert('respect');
$validator->assert('validation');
```

## Next steps

- Explore the [Feature Guide](feature-guide.md) for more advanced usage.
- Check out the [List of Validators by Category](list-of-validators-by-category.md) for a comprehensive list of available validators.
