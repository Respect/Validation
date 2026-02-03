<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# Json

- `Json()`

Validates if the given input is a valid JSON.

```php
v::json()->assert('{"foo":"bar"}');
// Validation passes successfully
```

## Templates

### `Json::TEMPLATE_STANDARD`

|       Mode | Template                                    |
| ---------: | :------------------------------------------ |
|  `default` | {{subject}} must be a valid JSON string     |
| `inverted` | {{subject}} must not be a valid JSON string |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description |
| ------: | :---------- |
|   0.3.9 | Created     |

## See Also

- [Domain](Domain.md)
- [Email](Email.md)
- [Phone](Phone.md)
