<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Factory

- `Factory(callable(mixed): Validator $factory)`

Validates the input using a validator that is created from a callback.

```php
v::factory(static fn($input) => v::boolVal())->assert(true);
// Validation passes successfully
```

This validator is particularly useful when creating validators that rely on the input. A good example is validating whether a
`confirmation` field matches the `password` field when processing data from a form.

```php
v::key('confirmation', v::equals($_POST['password'] ?? null))->assert($_POST);
// → `.confirmation` must be present
```

The issue with the code is that it’s hard to reuse because you’re relying upon the input itself (`$_POST`). That means
you can create a chain of validators and use it everywhere.

The `factory()` validator makes this job much simpler and more elegantly:

```php
v::factory(static fn($input) => v::key('confirmation', v::equals($input['password'] ?? null)))->assert($_POST);
// → `.confirmation` must be present
```

The code above is similar to the first example, but the biggest difference is that the creation of the validator doesn't rely
on the input itself (`$_POST`), but it will use any input that’s given to the validator

## Templates

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Callables
- Nesting

## Changelog

| Version | Description             |
| ------: | :---------------------- |
|   3.0.0 | Created from `KeyValue` |

## See Also

- [Call](Call.md)
- [CallableType](CallableType.md)
- [Circuit](Circuit.md)
