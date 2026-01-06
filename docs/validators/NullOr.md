# NullOr

- `NullOr(Validator $validator)`

Validates the input using a defined validator when the input is not `null`.

## Usage

```php
v::nullable(v::email())->assert(null);
// → "nullable" is not a valid rule name

v::nullable(v::email())->assert('example@example.com');
// → "nullable" is not a valid rule name

v::nullable(v::email())->assert('not an email');
// → "nullable" is not a valid rule name
```

## Prefix

For convenience, you can use `nullOr` as a prefix to any validator:

```php
v::nullOrEmail()->assert('not an email');
// → "not an email" must be a valid email address or must be null

v::nullOrBetween(1, 3)->assert(2);
// Validation passes successfully

v::nullOrBetween(1, 3)->assert(null);
// Validation passes successfully
```

## Templates

### `NullOr::TEMPLATE_STANDARD`

| Mode       | Template             |
| ---------- | -------------------- |
| `default`  | or must be null      |
| `inverted` | and must not be null |

The templates from this validator serve as message suffixes:

```php
v::nullOr(v::alpha())->assert('has1number');
// → "has1number" must contain only letters (a-z) or must be null

v::not(v::nullOr(v::alpha()))->assert("alpha");
// → "alpha" must not contain letters (a-z) and must not be null
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
|   3.0.0 | Renamed to `NullOr`   |
|   2.0.0 | Created as `Nullable` |

---

See also:

- [Attributes](Attributes.md)
- [NullType](NullType.md)
- [UndefOr](UndefOr.md)
