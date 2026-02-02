<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Decimal

- `Decimal(int $decimals)`

Validates whether the input matches the expected number of decimals.

```php
v::decimal(2)->assert('27990.50');
// Validation passes successfully

v::decimal(1)->assert('27990.50');
// → "27990.50" must have 1 decimal places

v::decimal(1)->assert(1.5);
// Validation passes successfully
```

## Known limitations

When validating float types, it is not possible to determine the amount of
ending zeros and because of that, validations like the ones below will pass.

```php
v::decimal(1)->assert(1.50);
// Validation passes successfully
```

## Templates

### `Decimal::TEMPLATE_STANDARD`

|       Mode | Template                                              |
| ---------: | :---------------------------------------------------- |
|  `default` | {{subject}} must have {{decimals}} decimal places     |
| `inverted` | {{subject}} must not have {{decimals}} decimal places |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `decimals`  |                                                                  |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers

## Changelog

| Version | Description                                     |
| ------: | :---------------------------------------------- |
|   3.0.0 | Templates changed                               |
|   2.2.4 | Float values with trailing zeroes are now valid |
|   2.0.0 | Created                                         |

## See Also

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Consonant](Consonant.md)
- [CreditCard](CreditCard.md)
- [Emoji](Emoji.md)
- [Factor](Factor.md)
- [Finite](Finite.md)
- [Infinite](Infinite.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [NumericVal](NumericVal.md)
- [Regex](Regex.md)
- [Uuid](Uuid.md)
- [Vowel](Vowel.md)
- [Xdigit](Xdigit.md)
