<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# NoneOf

- `NoneOf(Validator $validator1, Validator $validator2)`
- `NoneOf(Validator $validator1, Validator $validator2, Validator ...$validators)`

Validates if NONE of the given validators validate:

```php
v::noneOf(v::intVal(), v::floatVal())->assert('foo');
// Validation passes successfully
```

In the sample above, 'foo' isn't a integer nor a float, so noneOf returns true.

## Templates

### `NoneOf::TEMPLATE_SOME`

Used when some validators have passed.

| Mode       | Template                        |
| ---------- | ------------------------------- |
| `default`  | {{subject}} must pass the rules |
| `inverted` | {{subject}} must pass the rules |

### `NoneOf::TEMPLATE_ALL`

Used when all validators have passed.

| Mode       | Template                            |
| ---------- | ----------------------------------- |
| `default`  | {{subject}} must pass all the rules |
| `inverted` | {{subject}} must pass all the rules |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Composite
- Nesting

## Changelog

| Version | Description                                   |
| ------: | --------------------------------------------- |
|   3.0.0 | Require at least two validators to be defined |
|   0.3.9 | Created                                       |

---

See also:

- [AllOf](AllOf.md)
- [AnyOf](AnyOf.md)
- [Circuit](Circuit.md)
- [Not](Not.md)
- [OneOf](OneOf.md)
- [When](When.md)
