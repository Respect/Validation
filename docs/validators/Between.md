<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# Between

- `Between(mixed $minValue, mixed $maxValue)`

Validates whether the input is between two other values.

```php
v::intVal()->between(10, 20)->assert(10);
// Validation passes successfully

v::intVal()->between(10, 20)->assert(15);
// Validation passes successfully

v::intVal()->between(10, 20)->assert(20);
// Validation passes successfully
```

Validation makes comparison easier, check out our supported
[comparable values](../comparable-values.md).

Message template for this validator includes `{{minValue}}` and `{{maxValue}}`.

## Templates

### `Between::TEMPLATE_STANDARD`

|       Mode | Template                                                      |
| ---------: | :------------------------------------------------------------ |
|  `default` | {{subject}} must be between {{minValue}} and {{maxValue}}     |
| `inverted` | {{subject}} must not be between {{minValue}} and {{maxValue}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `maxValue`  | The minimum value passed to the validator.                       |
| `minValue`  | The maximum value passed to the validator.                       |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Comparisons

## Changelog

| Version | Description                 |
| ------: | :-------------------------- |
|   2.0.0 | Became always inclusive     |
|   1.0.0 | Became inclusive by default |
|   0.3.9 | Created                     |

## See Also

- [BetweenExclusive](BetweenExclusive.md)
- [DateTime](DateTime.md)
- [GreaterThan](GreaterThan.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [Length](Length.md)
- [LessThan](LessThan.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
- [Min](Min.md)
