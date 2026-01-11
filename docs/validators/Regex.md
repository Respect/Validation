# Regex

- `Regex(string $regex)`

Validates whether the input matches a defined regular expression.

```php
v::regex('/[a-z]/')->isValid('a'); // true
```

Message template for this validator includes `{{regex}}`.

## Templates

### `Regex::TEMPLATE_STANDARD`

| Mode       | Template                                                    |
| ---------- | ----------------------------------------------------------- |
| `default`  | {{subject}} must match the pattern {{regex&#124;quote}}     |
| `inverted` | {{subject}} must not match the pattern {{regex&#124;quote}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |
| `regex`     |                                                                  |

## Categorization

- Strings

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.3.9 | Created     |

---

See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Contains](Contains.md)
- [CreditCard](CreditCard.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [EndsWith](EndsWith.md)
- [PhpLabel](PhpLabel.md)
- [Roman](Roman.md)
- [StartsWith](StartsWith.md)
- [Version](Version.md)
