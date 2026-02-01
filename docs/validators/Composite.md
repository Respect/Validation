<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Composite

- `Composite()`
- `Composite(Validator ...$validators)`

Consolidates zero or more validators into a single validator.

- When no validators are provided, it acts as [AlwaysValid](AlwaysValid.md).
- When a single validator is provided, it acts as a pass-through.
- When multiple validators are provided, they are combined using [AllOf](AllOf.md), meaning all validators must pass for the input to be considered valid.

```php
v::composite()->assert('anything');
// Validation passes successfully

v::composite(v::intType())->assert(42);
// Validation passes successfully

v::composite(v::intType(), v::positive(), v::lessThan(100))->assert(42);
// Validation passes successfully

v::composite(v::intType(), v::positive())->assert(-5);
// → -5 must be a positive number
```

## Use cases

This validator is useful for dynamically building validation chains or when you
have a variable number of validators that need to be applied together.

```php
$validators = [v::stringType(), v::notSpaced()];

if (true) { // some condition
    $validators[] = v::email();
}

v::composite(...$validators)->assert('respectpanda#example.com');
// → "respectpanda#example.com" must be a valid email address
```

## Categorization

- Composite
- Nesting

## Changelog

| Version | Description |
| ------: | :---------- |
|   3.0.0 | Created     |

## See Also

- [AllOf](AllOf.md)
- [AlwaysValid](AlwaysValid.md)
- [AnyOf](AnyOf.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
