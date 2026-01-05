# Charset

- `Charset(string ...$charset)`

Validates if a string is in a specific charset.

```php
v::charset('ASCII')->isValid('açúcar'); // false
v::charset('ASCII')->isValid('sugar');  //true
v::charset('ISO-8859-1', 'EUC-JP')->isValid('日本国'); // true
```

The array format is a logic OR, not AND.

## Templates

### `Charset::TEMPLATE_STANDARD`

| Mode       | Template                                                                          |
| ---------- | --------------------------------------------------------------------------------- |
| `default`  | {{subject}} must only contain characters from the {{charset&#124;raw}} charset    |
| `inverted` | {{subject}} must not contain any characters from the {{charset&#124;raw}} charset |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `charset`   |                                                                  |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                                           |
| ------: | ----------------------------------------------------- |
|   2.0.0 | Charset supports multiple charsets on its constructor |
|   0.5.0 | Created                                               |

---

See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [PhpLabel](PhpLabel.md)
