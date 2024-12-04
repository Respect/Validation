# AlwaysInvalid

- `AlwaysInvalid()`

Validates any input as invalid.

```php
v::alwaysInvalid()->isValid('whatever'); // false
```

## Templates

`AlwaysInvalid::TEMPLATE_STANDARD`

| Mode       | Template                 |
|------------|--------------------------|
| `default`  | {{name}} must be valid   |
| `inverted` | {{name}} must be invalid |

`AlwaysInvalid::TEMPLATE_SIMPLE`

| Mode       | Template            |
|------------|---------------------|
| `default`  | {{name}} is invalid |
| `inverted` | {{name}} is valid   |

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

- [AlwaysValid](AlwaysValid.md)
- [When](When.md)
