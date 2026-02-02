<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
SPDX-FileContributor: Rakshit <rakshit087@gmail.com>
SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
-->

# CreditCard

- `CreditCard()`
- `CreditCard(string $brand)`

Validates a credit card number.

```php
v::creditCard()->assert('5376 7473 9720 8720');
// Validation passes successfully

v::creditCard()->assert('5376-7473-9720-8720');
// Validation passes successfully

v::creditCard()->assert('5376.7473.9720.8720');
// Validation passes successfully

v::creditCard('American Express')->assert('340316193809364');
// Validation passes successfully

v::creditCard('Diners Club')->assert('30351042633884');
// Validation passes successfully

v::creditCard('Discover')->assert('6011000990139424');
// Validation passes successfully

v::creditCard('JCB')->assert('3566002020360505');
// Validation passes successfully

v::creditCard('MasterCard')->assert('5376747397208720');
// Validation passes successfully

v::creditCard('Visa')->assert('4024007153361885');
// Validation passes successfully

v::creditCard('RuPay')->assert('6062973831636410');
// Validation passes successfully
```

The current supported brands are:

- American Express (`'American_Express'` or `CreditCard::AMERICAN_EXPRESS`)
- Diners Club (`'Diners_Club'` or `CreditCard::DINERS_CLUB`)
- Discover (`'Discover'` or `CreditCard::DISCOVER`)
- JCB (`'JCB'` or `CreditCard::JCB`)
- Mastercard (`'American_Express'` or `CreditCard::MASTERCARD`)
- Visa (`'Visa'` or `CreditCard::VISA`)
- RuPay (`'RuPay'` or `CreditCard::RUPAY`)

It ignores any non-numeric characters, use [Digit](Digit.md),
[Spaced](Spaced.md), or [Regex](Regex.md) when appropriate.

```php
v::digit()->creditCard()->assert('5376747397208720');
// Validation passes successfully
```

## Templates

### `CreditCard::TEMPLATE_STANDARD`

|       Mode | Template                                     |
| ---------: | :------------------------------------------- |
|  `default` | {{subject}} must be a credit card number     |
| `inverted` | {{subject}} must not be a credit card number |

### `CreditCard::TEMPLATE_BRANDED`

|       Mode | Template                                                        |
| ---------: | :-------------------------------------------------------------- |
|  `default` | {{subject}} must be a {{brand&#124;raw}} credit card number     |
| `inverted` | {{subject}} must not be a {{brand&#124;raw}} credit card number |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `brand`     |                                                                  |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Banking

## Changelog

| Version | Description                        |
| ------: | :--------------------------------- |
|   3.0.0 | Templates changed                  |
|   2.2.4 | RuPay is now supported as a brand  |
|   1.1.0 | Allow the define credit card brand |
|   0.3.9 | Created                            |

## See Also

- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [Iban](Iban.md)
- [Luhn](Luhn.md)
- [Regex](Regex.md)
- [Spaced](Spaced.md)
