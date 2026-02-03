<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# Slug

- `Slug()`

Validates whether the input is a valid slug.

```php
v::slug()->assert('my-wordpress-title');
// Validation passes successfully

v::slug()->assert('my-wordpress--title');
// → "my-wordpress--title" must be a valid slug

v::slug()->assert('my-wordpress-title-');
// → "my-wordpress-title-" must be a valid slug
```

## Templates

### `Slug::TEMPLATE_STANDARD`

|       Mode | Template                             |
| ---------: | :----------------------------------- |
|  `default` | {{subject}} must be a valid slug     |
| `inverted` | {{subject}} must not be a valid slug |

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

- [Url](Url.md)
