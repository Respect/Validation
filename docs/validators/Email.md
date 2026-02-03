<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Email

- `Email()`

Validates an email address.

```php
v::email()->assert('alganet@gmail.com');
// Validation passes successfully
```

## Templates

### `Email::TEMPLATE_STANDARD`

|       Mode | Template                                  |
| ---------: | :---------------------------------------- |
|  `default` | {{subject}} must be a valid email address |
| `inverted` | {{subject}} must not be an email address  |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Internet

## Changelog

| Version | Description                                       |
| ------: | :------------------------------------------------ |
|   2.3.0 | Use "egulias/emailvalidator" version 4.0          |
|   0.9.0 | Use "egulias/emailvalidator" for email validation |
|   0.3.9 | Created                                           |

## See Also

- [Json](Json.md)
- [Phone](Phone.md)
- [Url](Url.md)
