<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# ScalarVal

- `ScalarVal()`

Validates whether the input is a scalar value or not.

```php
v::scalarVal()->assert([]);
// → `[]` must be a scalar value

v::scalarVal()->assert(135.0);
// Validation passes successfully
```

## Templates

### `ScalarVal::TEMPLATE_STANDARD`

|       Mode | Template                               |
| ---------: | :------------------------------------- |
|  `default` | {{subject}} must be a scalar value     |
| `inverted` | {{subject}} must not be a scalar value |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Types

## Changelog

| Version | Description |
| ------: | :---------- |
|   1.0.0 | Created     |

## See Also

- [ArrayVal](ArrayVal.md)
- [NumericVal](NumericVal.md)
- [StringType](StringType.md)
