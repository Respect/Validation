<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Subset

- `Subset(mixed[] $superset)`

Validates whether the input is a subset of a given value.

```php
v::subset([1, 2, 3])->assert([1, 2]);
// Validation passes successfully

v::subset([1, 2])->assert([1, 2, 3]);
// → `[1, 2, 3]` must be subset of `[1, 2]`
```

## Templates

### `Subset::TEMPLATE_STANDARD`

|       Mode | Template                                       |
| ---------: | :--------------------------------------------- |
|  `default` | {{subject}} must be subset of {{superset}}     |
| `inverted` | {{subject}} must not be subset of {{superset}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |
| `superset`  |                                                                  |

## Categorization

- Arrays

## Changelog

| Version | Description |
| ------: | :---------- |
|   2.0.0 | Created     |

## See Also

- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
