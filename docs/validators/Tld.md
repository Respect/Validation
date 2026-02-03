<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# Tld

- `Tld()`

Validates whether the input is a top-level domain.

```php
v::tld()->assert('com');
// Validation passes successfully

v::tld()->assert('ly');
// Validation passes successfully

v::tld()->assert('org');
// Validation passes successfully

v::tld()->assert('COM');
// Validation passes successfully
```

## Templates

### `Tld::TEMPLATE_STANDARD`

|       Mode | Template                                              |
| ---------: | :---------------------------------------------------- |
|  `default` | {{subject}} must be a valid top-level domain name     |
| `inverted` | {{subject}} must not be a valid top-level domain name |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Internet

## Changelog

| Version | Description |
| ------: | :---------- |
|   0.3.9 | Created     |

## See Also

- [CountryCode](CountryCode.md)
- [Domain](Domain.md)
- [Ip](Ip.md)
- [MacAddress](MacAddress.md)
- [PublicDomainSuffix](PublicDomainSuffix.md)
- [SubdivisionCode](SubdivisionCode.md)
