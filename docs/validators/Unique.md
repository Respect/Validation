<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
SPDX-FileContributor: Krzysztof Śmiałek <admin@avensome.net>
-->

# Unique

- `Unique()`

Validates whether the input array contains only unique values.

```php
v::unique()->assert([]);
// Validation passes successfully

v::unique()->assert([1, 2, 3]);
// Validation passes successfully

v::unique()->assert([1, 2, 2, 3]);
// → `[1, 2, 2, 3]` must not contain duplicates

v::unique()->assert([1, 2, 3, 1]);
// → `[1, 2, 3, 1]` must not contain duplicates
```

## Templates

### `Unique::TEMPLATE_STANDARD`

|       Mode | Template                                |
| ---------: | :-------------------------------------- |
|  `default` | {{subject}} must not contain duplicates |
| `inverted` | {{subject}} must contain duplicates     |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays

## Changelog

| Version | Description |
| ------: | :---------- |
|   2.0.0 | Created     |

## See Also

- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [Contains](Contains.md)
- [Each](Each.md)
