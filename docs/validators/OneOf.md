<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# OneOf

- `OneOf(Validator $validator1, Validator $validator2)`
- `OneOf(Validator $validator1, Validator $validator2, Validator ...$validators)`

Will validate if exactly one inner validator passes.

```php
v::oneOf(v::digit(), v::alpha())->assert('AB');
// Validation passes successfully

v::oneOf(v::digit(), v::alpha())->assert('12');
// Validation passes successfully

v::oneOf(v::digit(), v::alpha())->assert('AB12');
// → - "AB12" must pass one of the rules
// →   - "AB12" must contain only digits (0-9)
// →   - "AB12" must contain only letters (a-z)

v::oneOf(v::digit(), v::alpha())->assert('*');
// → - "*" must pass one of the rules
// →   - "*" must contain only digits (0-9)
// →   - "*" must contain only letters (a-z)
```

The chains above validate if the input is either a digit or an alphabetic
character, one or the other, but not neither nor both.

## Templates

### `OneOf::TEMPLATE_NONE`

Used when none of the validators have passed.

| Mode       | Template                               |
| ---------- | -------------------------------------- |
| `default`  | {{subject}} must pass one of the rules |
| `inverted` | {{subject}} must pass one of the rules |

### `OneOf::TEMPLATE_MORE_THAN_ONE`

Used when more than one validator has passed.

| Mode       | Template                                    |
| ---------- | ------------------------------------------- |
| `default`  | {{subject}} must pass only one of the rules |
| `inverted` | {{subject}} must pass only one of the rules |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Composite
- Nesting

## Changelog

| Version | Description                                  |
| ------: | -------------------------------------------- |
|   3.0.0 | Require at least two validators to be passed |
|   0.3.9 | Created                                      |

---

See also:

- [AllOf](AllOf.md)
- [AnyOf](AnyOf.md)
- [Circuit](Circuit.md)
- [NoneOf](NoneOf.md)
- [When](When.md)
