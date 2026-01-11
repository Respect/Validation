# UndefOr

- `UndefOr(Validator $validator)`

Validates the input using a defined validator when the input is not `null` or an empty string (`''`).

This validator can be particularly useful when validating form fields.

## Usage

```php
v::undefOr(v::alpha())->isValid(''); // true
v::undefOr(v::digit())->isValid(null); // true

v::undefOr(v::alpha())->isValid('username'); // true
v::undefOr(v::alpha())->isValid('has1number'); // false
```

## Prefix

For convenience, you can use the `undefOr` as a prefix to any validator:

```php
v::undefOrEmail()->isValid('not an email'); // false
v::undefOrBetween(1, 3)->isValid(2); // true
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
// "has1number" must contain only letters (a-z) or must be undefined

v::not(v::undefOr(v::alpha()))->assert("alpha");
// "alpha" must not contain letters (a-z) and must not be undefined
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
