<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# ContainsCount

- `ContainsCount(mixed $containsValue, int $count)`
- `ContainsCount(mixed $containsValue, int $count, bool $identical)`

Validates if the input contains a value a specific number of times.

For strings:

```php
v::containsCount('ipsum', 2)->assert('ipsum lorem ipsum');
// Validation passes successfully
```

For arrays:

```php
v::containsCount('ipsum', 2)->assert(['ipsum', 'lorem', 'ipsum']);
// Validation passes successfully
```

A third parameter may be passed for identical comparison instead of equal comparison.

```php
v::containsCount(1, 1, true)->assert([1, 2, 3]);
// Validation passes successfully

v::containsCount('1', 1, true)->assert([1, 2, 3]);
// → `[1, 2, 3]` must contain "1" only once
```

## Templates

### `ContainsCount::TEMPLATE_TIMES`

| Mode       | Template                                                         |
| ---------- | ---------------------------------------------------------------- |
| `default`  | {{subject}} must contain {{containsValue}} {{count}} time(s)     |
| `inverted` | {{subject}} must not contain {{containsValue}} {{count}} time(s) |

### `ContainsCount::TEMPLATE_ONCE`

| Mode       | Template                                                 |
| ---------- | -------------------------------------------------------- |
| `default`  | {{subject}} must contain {{containsValue}} only once     |
| `inverted` | {{subject}} must not contain {{containsValue}} only once |

## Template placeholders

| Placeholder     | Description                                                      |
| --------------- | ---------------------------------------------------------------- |
| `containsValue` | The value to search for in the input.                            |
| `subject`       | The validated input or the custom validator name (if specified). |
| `count`         | Number of times that the needle might appear in the haystack.    |

## Categorization

- Arrays
- Strings

## Changelog

| Version | Description |
| ------: | ----------- |
|   3.0.0 | Created     |

---

See also:

- [Contains](Contains.md)
- [ContainsAny](ContainsAny.md)
- [EndsWith](EndsWith.md)
- [Equals](Equals.md)
- [Equivalent](Equivalent.md)
- [Identical](Identical.md)
- [In](In.md)
- [Regex](Regex.md)
- [StartsWith](StartsWith.md)
- [Unique](Unique.md)
