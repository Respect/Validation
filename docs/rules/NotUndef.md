# NotUndef

- `NotUndef()`

Validates if the given input is not optional. By _optional_ we consider `null`
or an empty string (`''`).

```php
v::notUndef()->isValid(''); // false
v::notUndef()->isValid(null); // false
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

| Mode       | Template                    |
|------------|-----------------------------|
| `default`  | The value must be defined   |
| `inverted` | The value must be undefined |

### `NotUndef::TEMPLATE_NAMED`

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
