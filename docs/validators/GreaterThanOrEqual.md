<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# GreaterThanOrEqual

- `GreaterThanOrEqual(mixed $compareTo)`

Validates whether the input is greater than or equal to a value.

```php
v::intVal()->greaterThanOrEqual(10)->assert(10);
// Validation passes successfully

v::intVal()->greaterThanOrEqual(10)->assert(9);
// → 9 must be greater than or equal to 10

v::intVal()->greaterThanOrEqual(10)->assert(11);
// Validation passes successfully
```

Validation makes comparison easier, check out our supported
[comparable values](../comparable-values.md).

Message template for this validator includes `{{compareTo}}`.

## Templates

### `GreaterThanOrEqual::TEMPLATE_STANDARD`

|       Mode | Template                                                   |
| ---------: | :--------------------------------------------------------- |
|  `default` | {{subject}} must be greater than or equal to {{compareTo}} |
| `inverted` | {{subject}} must be less than {{compareTo}}                |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `compareTo` | Value to be compared against the input.                          |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Comparisons

## Changelog

| Version | Description                                |
| ------: | :----------------------------------------- |
|   3.0.0 | Renamed from "Min" to "GreaterThanOrEqual" |
|   2.0.0 | Became always inclusive                    |
|   1.0.0 | Became inclusive by default                |
|   0.3.9 | Created                                    |

## See Also

- [Between](Between.md)
- [BetweenExclusive](BetweenExclusive.md)
- [GreaterThan](GreaterThan.md)
- [Length](Length.md)
- [LessThan](LessThan.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
- [Min](Min.md)
