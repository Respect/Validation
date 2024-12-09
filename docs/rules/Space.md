# Space

- `Space()`
- `Space(string ...$additionalChars)`

Validates whether the input contains only whitespaces characters.

```php
v::space()->isValid('    '); // true
```

## Templates

### `Space::TEMPLATE_STANDARD`

| Mode       | Template                                    |
|------------|---------------------------------------------|
| `default`  | {{name}} must contain only space characters |
| `inverted` | {{name}} must not contain space characters  |

### `Space::TEMPLATE_EXTRA`

| Mode       | Template                                                            |
|------------|---------------------------------------------------------------------|
| `default`  | {{name}} must contain only space characters and {{additionalChars}} |
| `inverted` | {{name}} must not contain space characters or {{additionalChars}}   |

## Template placeholders

| Placeholder       | Description                                                      |
|-------------------|------------------------------------------------------------------|
| `additionalChars` | Additional characters that are considered valid.                 |
| `name`            | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description |
|--------:|-------------|
|   0.5.0 | Created     |

***
See also:

- [Control](Control.md)
