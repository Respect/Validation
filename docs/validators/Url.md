<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Url

- `Url()`

Validates whether the input is a valid URL in a popular internet format.

```php
v::url()->assert('http://example.com');
// Validation passes successfully

v::url()->assert('https://www.youtube.com/watch?v=6FOUqQt3Kg0');
// Validation passes successfully

v::url()->assert('ldap://[::1]');
// Validation passes successfully

v::url()->assert('mailto:john.doe@example.com');
// Validation passes successfully

v::url()->assert('http://example.this_top_level_domain_does_not_exist');
// → "http://example.this_top_level_domain_does_not_exist" must be a valid URL
```

This validator uses [Ip][Ip.md], [Domain][Domain.md] and [Email][Email.md] internally,
activating them depending on the input scheme.

If you want to restrict URLs to a specific scheme, you can use [StartsWith][StartsWith.md]
or any other verifier:

```php
v::startsWith('http')->url()->assert('http://example.com');
// Validation passes successfully

v::startsWith('http')->url()->assert('ftp://example.com');
// → "ftp://example.com" must start with "http"
```

## Templates

### `Url::TEMPLATE_STANDARD`

|       Mode | Template                            |
| ---------: | :---------------------------------- |
|  `default` | {{subject}} must be a valid URL     |
| `inverted` | {{subject}} must not be a valid URL |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Internet

## Changelog

| Version | Description                                                                 |
| ------: | :-------------------------------------------------------------------------- |
|   3.0.0 | Stricter use of `Ip`, `Domain` and `Email` internally. Select schemes only. |
|   0.8.0 | Created                                                                     |

## See Also

- [Domain](Domain.md)
- [Email](Email.md)
- [Ip](Ip.md)
- [Phone](Phone.md)
- [Slug](Slug.md)
