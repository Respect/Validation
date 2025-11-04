# NotUndef

- `NotUndef()`

Validates whether the input is not "undefined" (not null or empty string):

```php
v::notUndef()->isValid(null); // false
v::notUndef()->isValid(''); // false
v::notUndef()->isValid(' '); // true
v::notUndef()->isValid('0'); // true
v::notUndef()->isValid(0); // true
v::notUndef()->isValid(false); // true
v::notUndef()->isValid([]); // false
v::notUndef()->isValid(['']); // true
v::notUndef()->isValid([0]); // true
v::notUndef()->isValid(new stdClass()); // true
```

## Deprecation Notice

**Changed in v3.0**: This rule was previously named `NotOptional`. The `NotOptional` rule has been renamed to `NotUndef` for consistency with the `UndefOr` rename.

```php
// Old v2.4 syntax (deprecated)
v::notOptional()->isValid('value'); // true

// New v3.0 syntax
v::notUndef()->isValid('value'); // true
```

Other values:

```php
v::notUndef()->isValid([]); // true
v::notUndef()->isValid(' '); // true
v::notUndef()->isValid(0); // true
v::notUndef()->isValid('0'); // true
v::notUndef()->isValid(0); // true
v::notUndef()->isValid('0.0'); // true
v::notUndef()->isValid(false); // true
v::notUndef()->isValid(['']); // true
v::notUndef()->isValid([' ']); // true
v::notUndef()->isValid([0]); // true
v::notUndef()->isValid(['0']); // true
v::notUndef()->isValid([false]); // true
v::notUndef()->isValid([[''), [0]]); // true
v::notUndef()->isValid(new stdClass()); // true
```

## Templates

### `NotUndef::TEMPLATE_STANDARD`

| Mode       | Template                   |
|------------|----------------------------|
| `default`  | {{name}} must be defined   |
| `inverted` | {{name}} must be undefined |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Miscellaneous

## Changelog

| Version | Description                              |
|--------:|------------------------------------------|
|   3.0.0 | Renamed from "NotOptional" to "NotUndef" |
|   1.0.0 | Created                                  |

***
See also:

- [NoWhitespace](NoWhitespace.md)
- [NotBlank](NotBlank.md)
- [NotEmpty](NotEmpty.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [UndefOr](UndefOr.md)
