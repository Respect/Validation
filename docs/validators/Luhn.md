# Luhn

- `Luhn()`

Validate whether a given input is a [Luhn][] number.

```php
v::luhn()->isValid('2222400041240011'); // true
v::luhn()->isValid('respect!'); // false
```

## Templates

### `Luhn::TEMPLATE_STANDARD`

| Mode       | Template                                    |
| ---------- | ------------------------------------------- |
| `default`  | {{subject}} must be a valid Luhn number     |
| `inverted` | {{subject}} must not be a valid Luhn number |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
| ------: | ----------- |
|   2.0.0 | Created     |

---

See also:

- [CreditCard](CreditCard.md)
- [Imei](Imei.md)
- [Isbn](Isbn.md)

[Luhn]: https://en.wikipedia.org/wiki/Luhn_algorithm
