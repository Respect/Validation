<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Base

- `Base(int $base)`
- `Base(int $base, string $chars)`

Validate numbers in any base, even with non regular bases.

```php
v::base(2)->assert('011010001');
// Validation passes successfully

v::base(3)->assert('0120122001');
// Validation passes successfully

v::base(8)->assert('01234567520');
// Validation passes successfully

v::base(16)->assert('012a34f5675c20d');
// Validation passes successfully

v::base(2)->assert('0120122001');
// → "0120122001" must be a number in base 2
```

## Templates

### `Base::TEMPLATE_STANDARD`

|       Mode | Template                                                   |
| ---------: | :--------------------------------------------------------- |
|  `default` | {{subject}} must be a number in base {{base&#124;raw}}     |
| `inverted` | {{subject}} must not be a number in base {{base&#124;raw}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `base`      | The base passed to the constructor of the validator.             |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers

## Changelog

| Version | Description |
| ------: | :---------- |
|   0.5.0 | Created     |

## See Also

- [Base64](Base64.md)
- [Uuid](Uuid.md)
