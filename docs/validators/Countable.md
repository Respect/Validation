<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Countable

- `Countable()`

Validates if the input is countable, in other words, if you're allowed to use
[count()](http://php.net/count) function on it.

```php
v::countable()->assert([]);
// Validation passes successfully

v::countable()->assert(new ArrayObject());
// Validation passes successfully

v::countable()->assert('string');
// → "string" must be a countable value
```

## Templates

### `Countable::TEMPLATE_STANDARD`

|       Mode | Template                                  |
| ---------: | :---------------------------------------- |
|  `default` | {{subject}} must be a countable value     |
| `inverted` | {{subject}} must not be a countable value |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Types

## Changelog

| Version | Description             |
| ------: | :---------------------- |
|   1.0.0 | Created from `ArrayVal` |

## See Also

- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [Instance](Instance.md)
- [IterableType](IterableType.md)
- [IterableVal](IterableVal.md)
