<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# EndsWith

- `EndsWith(mixed $endValue)`

This validator is similar to `Contains()`, but validates
only if the value is at the end of the input.

For strings:

```php
v::endsWith('ipsum')->assert('lorem ipsum');
// Validation passes successfully
```

For arrays:

```php
v::endsWith('ipsum')->assert(['lorem', 'ipsum']);
// Validation passes successfully
```

Message template for this validator includes `{{endValue}}`.

## Templates

### `EndsWith::TEMPLATE_STANDARD`

|       Mode | Template                                   |
| ---------: | :----------------------------------------- |
|  `default` | {{subject}} must end with {{endValue}}     |
| `inverted` | {{subject}} must not end with {{endValue}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `endValue`  |                                                                  |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays
- Strings

## Changelog

| Version | Description                         |
| ------: | :---------------------------------- |
|   3.0.0 | Case-insensitive comparison removed |
|   0.3.9 | Created                             |

## See Also

- [Contains](Contains.md)
- [In](In.md)
- [Regex](Regex.md)
- [StartsWith](StartsWith.md)
