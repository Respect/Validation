<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# UndefOr

- `UndefOr(Validator $validator)`

Validates the input using a defined validator when the input is not `null` or an empty string (`''`).

This validator can be particularly useful when validating form fields.

## Usage

```php
v::undefOr(v::alpha())->assert('');
// Validation passes successfully

v::undefOr(v::digit())->assert(null);
// Validation passes successfully

v::undefOr(v::alpha())->assert('username');
// Validation passes successfully

v::undefOr(v::alpha())->assert('has1number');
// → "has1number" must contain only letters (a-z) or must be undefined
```

## Prefix

For convenience, you can use the `undefOr` as a prefix to any validator:

```php
v::undefOrEmail()->assert('not an email');
// → "not an email" must be a valid email address or must be undefined

v::undefOrBetween(1, 3)->assert(2);
// Validation passes successfully
```

## Templates

### `UndefOr::TEMPLATE_STANDARD`

| Mode       | Template                  |
| ---------- | ------------------------- |
| `default`  | or must be undefined      |
| `inverted` | and must not be undefined |

## Template as suffix

The template serves as a suffix to the template of the inner validator.

```php
v::undefOr(v::alpha())->assert('has1number');
// → "has1number" must contain only letters (a-z) or must be undefined

v::not(v::undefOr(v::alpha()))->assert("alpha");
// → "alpha" must not contain letters (a-z) and must not be undefined
```

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Nesting

## Changelog

| Version | Description           |
| ------: | --------------------- |
|   3.0.0 | Renamed to `UndefOr`  |
|   1.0.0 | Created as `Optional` |

---

See also:

- [Blank](Blank.md)
- [Falsy](Falsy.md)
- [NullOr](NullOr.md)
- [NullType](NullType.md)
- [Spaced](Spaced.md)
- [Undef](Undef.md)
