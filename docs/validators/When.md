<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# When

- `When(Validator $when, Validator $then)`
- `When(Validator $when, Validator $then, Validator $else)`

A ternary validator that accepts three parameters.

When the `$if` validates, returns validation for `$then`.
When the `$if` doesn't validate, returns validation for `$else`, if defined.

```php
v::when(v::intVal(), v::positive(), v::notBlank())->assert(1);
// Validation passes successfully

v::when(v::intVal(), v::positive(), v::notBlank())->assert('non-blank string');
// Validation passes successfully

v::when(v::intVal(), v::positive(), v::notBlank())->assert(-1);
// → -1 must be a positive number

v::when(v::intVal(), v::positive(), v::notBlank())->assert('');
// → "" must not be blank
```

In the sample above, if `$input` is an integer, then it must be positive.
If `$input` is not an integer, then it must not be blank.
When `$else` is not defined use [AlwaysInvalid](AlwaysInvalid.md)

## Templates

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Conditions
- Nesting

## Changelog

| Version | Description                         |
| ------: | :---------------------------------- |
|   0.8.0 | Allow to use validator without else |
|   0.3.9 | Created                             |

## See Also

- [AllOf](AllOf.md)
- [AlwaysInvalid](AlwaysInvalid.md)
- [AnyOf](AnyOf.md)
- [Circuit](Circuit.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
