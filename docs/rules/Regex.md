# Regex

- `Regex(string $regex)`

Validates whether the input matches a defined regular expression.

```php
v::regex('/[a-z]/')->isValid('a'); // true
```

Message template for this validator includes `{{regex}}`.

## Templates

### `Regex::TEMPLATE_STANDARD`

| Mode       | Template                                                 |
|------------|----------------------------------------------------------|
| `default`  | {{name}} must match the pattern `{{regex&#124;raw}}`     |
| `inverted` | {{name}} must not match the pattern `{{regex&#124;raw}}` |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |
| `regex`     |                                                                  |

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
- [Contains](Contains.md)
- [CreditCard](CreditCard.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [EndsWith](EndsWith.md)
- [PhpLabel](PhpLabel.md)
- [Roman](Roman.md)
- [StartsWith](StartsWith.md)
- [Version](Version.md)
