<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# StartsWith

- `StartsWith(mixed $startValue)`
- `StartsWith(mixed $startValue, bool $identical)`

Validates whether the input starts with a given value.

This validator is similar to [Contains](Contains.md), but validates only
if the value is at the beginning of the input.

For strings:

```php
v::startsWith('lorem')->assert('lorem ipsum');
// Validation passes successfully
```

For arrays:

```php
v::startsWith('lorem')->assert(['lorem', 'ipsum']);
// Validation passes successfully
```

`true` may be passed as a parameter to indicate identical comparison
instead of equal.

Message template for this validator includes `{{startValue}}`.

## Templates

### `StartsWith::TEMPLATE_STANDARD`

|       Mode | Template                                       |
| ---------: | :--------------------------------------------- |
|  `default` | {{subject}} must start with {{startValue}}     |
| `inverted` | {{subject}} must not start with {{startValue}} |

## Template placeholders

| Placeholder  | Description                                                      |
| ------------ | ---------------------------------------------------------------- |
| `subject`    | The validated input or the custom validator name (if specified). |
| `startValue` |                                                                  |

## Categorization

- Arrays
- Strings

## Changelog

| Version | Description |
| ------: | :---------- |
|   0.3.9 | Created     |

## See Also

- [Contains](Contains.md)
- [EndsWith](EndsWith.md)
- [In](In.md)
- [Regex](Regex.md)
