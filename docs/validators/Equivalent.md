<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Equivalent

- `Equivalent(mixed $compareTo)`

Validates if the input is equivalent to some value.

```php
v::equivalent(1)->assert(true);
// Validation passes successfully

v::equivalent('Something')->assert('someThing');
// Validation passes successfully

v::equivalent(new ArrayObject([1, 2, 3, 4, 5]))->assert(new ArrayObject([1, 2, 3, 4, 5]));
// Validation passes successfully
```

This validator is very similar to [Equals](Equals.md) but it does not make case-sensitive
comparisons.

Message template for this validator includes `{{compareTo}}`.

## Templates

### `Equivalent::TEMPLATE_STANDARD`

|       Mode | Template                                            |
| ---------: | :-------------------------------------------------- |
|  `default` | {{subject}} must be equivalent to {{compareTo}}     |
| `inverted` | {{subject}} must not be equivalent to {{compareTo}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `compareTo` | Value to be compared against the input.                          |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Comparisons

## Changelog

| Version | Description |
| ------: | :---------- |
|   2.0.0 | Created     |

## See Also

- [Contains](Contains.md)
- [ContainsAny](ContainsAny.md)
- [Equals](Equals.md)
- [Identical](Identical.md)
