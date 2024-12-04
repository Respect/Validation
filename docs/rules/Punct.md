# Punct

- `Punct()`
- `Punct(string ...$additionalChars)`

Validates whether the input composed by only punctuation characters.

```php
v::punct()->isValid('&,.;[]'); // true
```

## Templates

`Punct::TEMPLATE_STANDARD`

| Mode       | Template                                          |
|------------|---------------------------------------------------|
| `default`  | {{name}} must contain only punctuation characters |
| `inverted` | {{name}} must not contain punctuation characters  |

`Punct::TEMPLATE_EXTRA`

| Mode       | Template                                                                  |
|------------|---------------------------------------------------------------------------|
| `default`  | {{name}} must contain only punctuation characters and {{additionalChars}} |
| `inverted` | {{name}} must not contain punctuation characters or {{additionalChars}}   |

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
- [Graph](Graph.md)
- [Printable](Printable.md)
