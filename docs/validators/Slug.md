<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Slug

- `Slug()`

Validates whether the input is a valid slug.

```php
v::slug()->assert('my-wordpress-title');
// Validation passes successfully

v::slug()->assert('my-wordpress--title');
// → "my-wordpress--title" must be a slug

v::slug()->assert('my-wordpress-title-');
// → "my-wordpress-title-" must be a slug
```

## Templates

### `Slug::TEMPLATE_STANDARD`

|       Mode | Template                       |
| ---------: | :----------------------------- |
|  `default` | {{subject}} must be a slug     |
| `inverted` | {{subject}} must not be a slug |

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
|   0.3.9 | Created           |

## See Also

- [Url](Url.md)
