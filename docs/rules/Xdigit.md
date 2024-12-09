# Xdigit

- `Xdigit()`
- `Xdigit(string ...$additionalChars)`

Validates whether the input is an hexadecimal number or not.

```php
v::xdigit()->isValid('abc123'); // true
```

Notice, however, that it doesn't accept strings starting with 0x:

```php
v::xdigit()->isValid('0x1f'); // false
```

## Templates

### `Xdigit::TEMPLATE_STANDARD`

| Mode       | Template                                          |
|------------|---------------------------------------------------|
| `default`  | {{name}} must only contain hexadecimal digits     |
| `inverted` | {{name}} must not only contain hexadecimal digits |

### `Xdigit::TEMPLATE_EXTRA`

| Mode       | Template                                                            |
|------------|---------------------------------------------------------------------|
| `default`  | {{name}} must contain hexadecimal digits and {{additionalChars}}    |
| `inverted` | {{name}} must not contain hexadecimal digits or {{additionalChars}} |

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

- [Alnum](Alnum.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [HexRgbColor](HexRgbColor.md)
