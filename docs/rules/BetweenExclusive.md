# BetweenExclusive

- `BetweenExclusive(mixed $minimum, mixed $maximum)`

Validates whether the input is between two other values, exclusively.

```php
v::betweenExclusive(10, 20)->isValid(10); // true
v::betweenExclusive('a', 'e')->isValid('c'); // true
v::betweenExclusive(new DateTime('yesterday'), new DateTime('tomorrow'))->isValid(new DateTime('today')); // true

v::betweenExclusive(0, 100)->isValid(100); // false
v::betweenExclusive('a', 'z')->isValid('a'); // false
```

Validation makes comparison easier, check out our supported [comparable values](../08-comparable-values.md).

## Templates

### `BetweenExclusive::TEMPLATE_STANDARD`

| Mode       | Template                                                                    |
| ---------- | --------------------------------------------------------------------------- |
| `default`  | {{subject}} must be greater than {{minValue}} and less than {{maxValue}}    |
| `inverted` | {{subject}} must not be greater than {{minValue}} or less than {{maxValue}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `maxValue`  | The minimum value passed to the rule.                            |
| `minValue`  | The maximum value passed to the rule.                            |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Comparisons

## Changelog

| Version | Description |
| ------: | ----------- |
|   3.0.0 | Created     |

---

See also:

- [Between](Between.md)
- [DateTime](DateTime.md)
- [GreaterThan](GreaterThan.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [Length](Length.md)
- [LessThan](LessThan.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
- [Min](Min.md)
