<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Base64

- `Base64()`

Validate if a string is Base64-encoded.

```php
v::base64()->assert('cmVzcGVjdCE=');
// Validation passes successfully

v::base64()->assert('respect!');
// → "respect!" must be a base64-encoded string
```

## Templates

### `Base64::TEMPLATE_STANDARD`

|       Mode | Template                                        |
| ---------: | :---------------------------------------------- |
|  `default` | {{subject}} must be a base64-encoded string     |
| `inverted` | {{subject}} must not be a base64-encoded string |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description       |
| ------: | :---------------- |
|   3.0.0 | Templates changed |
|   2.0.0 | Created           |

## See Also

- [Base](Base.md)
