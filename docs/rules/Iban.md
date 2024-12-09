# Iban

- `v::iban()`

Validates whether the input is a valid [IBAN][] (International Bank Account
Number) or not.

```php
v::iban()->isValid('SE35 5000 0000 0549 1000 0003'); // true
v::iban()->isValid('ch9300762011623852957'); // true

v::iban()->isValid('ZZ32 5000 5880 7742'); // false
v::iban()->isValid(123456789); // false
v::iban()->isValid(''); // false
```

## Templates

### `Iban::TEMPLATE_STANDARD`

| Mode       | Template                          |
|------------|-----------------------------------|
| `default`  | {{name}} must be a valid IBAN     |
| `inverted` | {{name}} must not be a valid IBAN |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Banking

## Changelog

| Version | Description |
|--------:|-------------|
|   2.0.0 | Created     |

***
See also:

- [CreditCard](CreditCard.md)
- [MacAddress](MacAddress.md)
- [PostalCode](PostalCode.md)

[IBAN]: https://en.wikipedia.org/wiki/International_Bank_Account_Number
