<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# IterableVal

- `IterableVal()`

Validates whether the input is an iterable value, in other words, if you can iterate over it with the [foreach][] language construct.

```php
v::iterableVal()->assert([]);
// Validation passes successfully

v::iterableVal()->assert(new ArrayObject());
// Validation passes successfully

v::iterableVal()->assert(new stdClass());
// Validation passes successfully

v::iterableVal()->assert('string');
// → "string" must be iterable
```

## Note

This validator doesn't behave as PHP's [is_iterable()][] function because it considers that you can iterate over any object.

## Templates

### `IterableVal::TEMPLATE_STANDARD`

|       Mode | Template                         |
| ---------: | :------------------------------- |
|  `default` | {{subject}} must be iterable     |
| `inverted` | {{subject}} must not be iterable |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Types

## Changelog

| Version | Description                                  |
| ------: | :------------------------------------------- |
|   3.0.0 | Templates changed                            |
|   3.0.0 | Renamed from `IterableType` to `IterableVal` |
|   1.0.8 | Renamed from `Iterable` to `IterableType`    |
|   1.0.0 | Created as `Iterable`                        |

## See Also

- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [Countable](Countable.md)
- [Each](Each.md)
- [Instance](Instance.md)
- [IterableType](IterableType.md)

[is_iterable()]: https://www.php.net/is_iterable
[foreach]: http://php.net/foreach
