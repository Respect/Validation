<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Undef

- `Undef()`

Validates if the given input is undefined. By _undefined_ we consider `null` or an empty string (`''`).

We recommend you to check [Comparing empty values](../comparing-empty-values.md) for more details.

```php
v::undef()->assert('');
// Validation passes successfully

v::undef()->assert(null);
// Validation passes successfully
```

Other values similar to _undefined_ values are considered _defined_:

```php
v::undef()->assert([]);
// → `[]` must be undefined

v::undef()->assert(' ');
// → " " must be undefined

v::undef()->assert(0);
// → 0 must be undefined

v::undef()->assert('0');
// → "0" must be undefined

v::undef()->assert('0.0');
// → "0.0" must be undefined

v::undef()->assert(false);
// → `false` must be undefined

v::undef()->assert(['']);
// → `[""]` must be undefined

v::undef()->assert([' ']);
// → `[" "]` must be undefined

v::undef()->assert([0]);
// → `[0]` must be undefined

v::undef()->assert(['0']);
// → `["0"]` must be undefined

v::undef()->assert([false]);
// → `[false]` must be undefined

v::undef()->assert([[''], [0]]);
// → `[[""], [0]]` must be undefined

v::undef()->assert(new stdClass());
// → `stdClass {}` must be undefined
```

## Templates

### `Undef::TEMPLATE_STANDARD`

| Mode       | Template                      |
| ---------- | ----------------------------- |
| `default`  | {{subject}} must be undefined |
| `inverted` | {{subject}} must be defined   |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Miscellaneous

## Changelog

| Version | Description                                 |
| ------: | ------------------------------------------- |
|   3.0.0 | Renamed to `Undef` and changed the behavior |
|   1.0.0 | Created as `NotOptional`                    |

---

See also:

- [Blank](Blank.md)
- [Falsy](Falsy.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [Spaced](Spaced.md)
- [UndefOr](UndefOr.md)
