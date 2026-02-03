<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# Contains

- `Contains(mixed $containsValue)`

Validates if the input contains some value.

For strings:

```php
v::contains('ipsum')->assert('lorem ipsum');
// Validation passes successfully
```

For arrays:

```php
v::contains('ipsum')->assert(['ipsum', 'lorem']);
// Validation passes successfully
```

Message template for this validator includes `{{containsValue}}`.

## Templates

### `Contains::TEMPLATE_STANDARD`

|       Mode | Template                                       |
| ---------: | :--------------------------------------------- |
|  `default` | {{subject}} must contain {{containsValue}}     |
| `inverted` | {{subject}} must not contain {{containsValue}} |

## Template placeholders

| Placeholder     | Description                                                      |
| --------------- | ---------------------------------------------------------------- |
| `containsValue` |                                                                  |
| `subject`       | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays
- Strings

## Changelog

| Version | Description                         |
| ------: | :---------------------------------- |
|   3.0.0 | Case-insensitive comparison removed |
|   0.3.9 | Created                             |

## See Also

- [ContainsAny](ContainsAny.md)
- [ContainsCount](ContainsCount.md)
- [EndsWith](EndsWith.md)
- [Equals](Equals.md)
- [Equivalent](Equivalent.md)
- [Identical](Identical.md)
- [In](In.md)
- [Regex](Regex.md)
- [StartsWith](StartsWith.md)
- [Unique](Unique.md)
