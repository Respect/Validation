<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# LessThan

- `LessThan(mixed $compareTo)`

Validates whether the input is less than a value.

```php
v::lessThan(10)->assert(9);
// Validation passes successfully

v::lessThan(10)->assert(10);
// → 10 must be less than 10
```

Validation makes comparison easier, check out our supported
[comparable values](../comparable-values.md).

Message template for this validator includes `{{compareTo}}`.

## Templates

### `LessThan::TEMPLATE_STANDARD`

|       Mode | Template                                        |
| ---------: | :---------------------------------------------- |
|  `default` | {{subject}} must be less than {{compareTo}}     |
| `inverted` | {{subject}} must not be less than {{compareTo}} |

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

- [Between](Between.md)
- [BetweenExclusive](BetweenExclusive.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [Length](Length.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
- [Min](Min.md)
