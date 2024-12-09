# AlwaysValid

- `AlwaysValid()`

Validates any input as valid.

```php
v::alwaysValid()->isValid('whatever'); // true
```

## Templates

### `AlwaysValid::TEMPLATE_STANDARD`

| Mode       | Template                 |
|------------|--------------------------|
| `default`  | {{name}} must be valid   |
| `inverted` | {{name}} must be invalid |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Booleans

## Changelog

| Version | Description |
|--------:|-------------|
|   0.5.0 | Created     |

***
See also:

- [AlwaysInvalid](AlwaysInvalid.md)
