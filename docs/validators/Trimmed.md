<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# Trimmed

- `Trimmed()`
- `Trimmed(string ...$trimValues)`

Validates whether the input string does not start or end with the given values.

When no values are provided, this validator uses a default list of Unicode invisible characters (including regular whitespace, non-breaking spaces, and zero-width characters).

With the default values:

```php
v::trimmed()->assert('lorem ipsum');
// Validation passes successfully

v::trimmed()->assert("\u{200B}lorem");
// → "​lorem" must not contain leading or trailing whitespace
```

With custom values:

```php
v::trimmed('Dr.', 'Mr.', 'PhD.')->assert('John');
// Validation passes successfully

v::trimmed('Dr.', 'Mr.', 'PhD.')->assert('Dr. John');
// → "Dr. John" must not contain leading or trailing "Dr.", "Mr.", or "PhD."

v::trimmed('Dr.', 'Mr.', ', PhD')->assert('John Doe, PhD');
// → "John Doe, PhD" must not contain leading or trailing "Dr.", "Mr.", or ", PhD"
```

This validator composes [StartsWith](StartsWith.md) and [EndsWith](EndsWith.md).

## Templates

### `Trimmed::TEMPLATE_STANDARD`

|       Mode | Template                                                    |
| ---------: | :---------------------------------------------------------- |
|  `default` | {{subject}} must not contain leading or trailing whitespace |
| `inverted` | {{subject}} must contain leading or trailing whitespace     |

### `Trimmed::TEMPLATE_CUSTOM`

|       Mode | Template                                                                     |
| ---------: | :--------------------------------------------------------------------------- |
|  `default` | {{subject}} must not contain leading or trailing {{trimValues&#124;list:or}} |
| `inverted` | {{subject}} must contain leading or trailing {{trimValues&#124;list:or}}     |

## Template placeholders

| Placeholder  | Description                                                      |
| ------------ | ---------------------------------------------------------------- |
| `subject`    | The validated input or the custom validator name (if specified). |
| `trimValues` | The values that will be checked at start end end of input.       |

## Categorization

- Strings

## Changelog

| Version | Description |
| ------: | :---------- |
|   3.1.0 | Created     |

## See Also

- [EndsWith](EndsWith.md)
- [Space](Space.md)
- [Spaced](Spaced.md)
- [StartsWith](StartsWith.md)
