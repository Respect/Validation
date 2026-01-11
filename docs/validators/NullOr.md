# NullOr

- `NullOr(Validator $validator)`

Validates the input using a defined validator when the input is not `null`.

## Usage

```php
v::nullable(v::email())->isValid(null); // true
v::nullable(v::email())->isValid('example@example.com'); // true
v::nullable(v::email())->isValid('not an email'); // false
```

## Prefix

For convenience, you can use `nullOr` as a prefix to any validator:

```php
v::nullOrEmail()->isValid('not an email'); // false
v::nullOrBetween(1, 3)->isValid(2); // true
v::nullOrBetween(1, 3)->isValid(null); // true
```

## Templates

### `NullOr::TEMPLATE_STANDARD`

| Mode       | Template             |
| ---------- | -------------------- |
| `default`  | or must be null      |
| `inverted` | and must not be null |

## Template as suffix

The template serves as a suffix to the template of the inner validator.

```php
v::nullOr(v::alpha())->assert('has1number');
// "has1number" must contain only letters (a-z) or must be null

v::not(v::nullOr(v::alpha()))->assert("alpha");
// "alpha" must not contain letters (a-z) and must not be null
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
