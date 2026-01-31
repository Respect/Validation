<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Url

- `Url()`

Validates whether the input is a URL.

```php
v::url()->assert('http://example.com');
// Validation passes successfully

v::url()->assert('https://www.youtube.com/watch?v=6FOUqQt3Kg0');
// Validation passes successfully

v::url()->assert('ldap://[::1]');
// Validation passes successfully

v::url()->assert('mailto:john.doe@example.com');
// Validation passes successfully

v::url()->assert('news:new.example.com');
// Validation passes successfully
```

## Templates

### `Url::TEMPLATE_STANDARD`

|       Mode | Template                      |
| ---------: | :---------------------------- |
|  `default` | {{subject}} must be a URL     |
| `inverted` | {{subject}} must not be a URL |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Internet

## Changelog

| Version | Description |
| ------: | :---------- |
|   0.8.0 | Created     |

## See Also

- [Domain](Domain.md)
- [Email](Email.md)
- [Phone](Phone.md)
- [Slug](Slug.md)
