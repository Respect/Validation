# Lowercase

- `Lowercase()`

Validates whether the characters in the input are lowercase.

```php
v::stringType()->lowercase()->isValid('xkcd'); // true
```

## Templates

### `Lowercase::TEMPLATE_STANDARD`

| Mode       | Template                                         |
|------------|--------------------------------------------------|
| `default`  | {{name}} must contain only lowercase letters     |
| `inverted` | {{name}} must not contain only lowercase letters |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description |
|--------:|-------------|
|   0.3.9 | Created     |

***
See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Uppercase](Uppercase.md)
