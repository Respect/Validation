<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Iban

- `Iban()`

Validates whether the input is a valid [IBAN][] (International Bank Account
Number) or not.

```php
v::iban()->assert('SE35 5000 0000 0549 1000 0003');
// Validation passes successfully

v::iban()->assert('ch9300762011623852957');
// → "ch9300762011623852957" must be an IBAN

v::iban()->assert('ZZ32 5000 5880 7742');
// → "ZZ32 5000 5880 7742" must be an IBAN

v::iban()->assert(123456789);
// → 123456789 must be an IBAN

v::iban()->assert('');
// → "" must be an IBAN
```

## Templates

### `Iban::TEMPLATE_STANDARD`

|       Mode | Template                        |
| ---------: | :------------------------------ |
|  `default` | {{subject}} must be an IBAN     |
| `inverted` | {{subject}} must not be an IBAN |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Banking

## Changelog

| Version | Description       |
| ------: | :---------------- |
|   3.0.0 | Templates changed |
|   2.0.0 | Created           |

## See Also

- [CreditCard](CreditCard.md)
- [MacAddress](MacAddress.md)
- [PostalCode](PostalCode.md)

[IBAN]: https://en.wikipedia.org/wiki/International_Bank_Account_Number
