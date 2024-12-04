# NotBlank

- `NotBlank()`

Validates if the given input is not a blank value (`null`, zeros, empty strings
or empty arrays, recursively).

```php
v::notBlank()->isValid(null); // false
v::notBlank()->isValid(''); // false
v::notBlank()->isValid([]); // false
v::notBlank()->isValid(' '); // false
v::notBlank()->isValid(0); // false
v::notBlank()->isValid('0'); // false
v::notBlank()->isValid(0); // false
v::notBlank()->isValid('0.0'); // false
v::notBlank()->isValid(false); // false
v::notBlank()->isValid(['']); // false
v::notBlank()->isValid([' ']); // false
v::notBlank()->isValid([0]); // false
v::notBlank()->isValid(['0']); // false
v::notBlank()->isValid([false]); // false
v::notBlank()->isValid([[''], [0]]); // false
v::notBlank()->isValid(new stdClass()); // false
```

It's similar to [NotEmpty](NotEmpty.md) but it's way more strict.

## Templates

`NotBlank::TEMPLATE_STANDARD`

| Mode       | Template                    |
|------------|-----------------------------|
| `default`  | The value must not be blank |
| `inverted` | The value must be blank     |

`NotBlank::TEMPLATE_NAMED`

| Mode       | Template                   |
|------------|----------------------------|
| `default`  | {{name}} must not be blank |
| `inverted` | {{name}} must be blank     |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Miscellaneous

## Changelog

| Version | Description |
|--------:|-------------|
|   1.0.0 | Created     |

***
See also:

- [NoWhitespace](NoWhitespace.md)
- [NotEmpty](NotEmpty.md)
- [NotUndef](NotUndef.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [UndefOr](UndefOr.md)
