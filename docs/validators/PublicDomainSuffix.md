<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# PublicDomainSuffix

- `PublicDomainSuffix()`

Validates whether the input is a public ICANN domain suffix.

```php
v::publicDomainSuffix()->assert('co.uk');
// Validation passes successfully

v::publicDomainSuffix()->assert('CO.UK');
// Validation passes successfully

v::publicDomainSuffix()->assert('nom.br');
// Validation passes successfully

v::publicDomainSuffix()->assert('invalid.com');
// → "invalid.com" must be a public domain suffix
```

This validator will not match top level domains such as `tk`.
If you want to match either, use a combination with `Tld`:

```php
v::oneOf(v::tld(), v::publicDomainSuffix())->assert('tk');
// Validation passes successfully
```

## Templates

### `PublicDomainSuffix::TEMPLATE_STANDARD`

|       Mode | Template                                       |
| ---------: | :--------------------------------------------- |
|  `default` | {{subject}} must be a public domain suffix     |
| `inverted` | {{subject}} must not be a public domain suffix |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Internet

## Changelog

| Version | Description       |
| ------: | :---------------- |
|   3.0.0 | Templates changed |
|   2.3.0 | Created           |

## See Also

- [CountryCode](CountryCode.md)
- [Domain](Domain.md)
- [Ip](Ip.md)
- [MacAddress](MacAddress.md)
- [SubdivisionCode](SubdivisionCode.md)
- [Tld](Tld.md)
