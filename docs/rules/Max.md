# Max

- `Max(Rule $rule)`

Validates the maximum value of the input against a given rule.

```php
v::max(v::equals(30))->isValid([10, 20, 30]); // true

v::max(v::between('e', 'g'))->isValid(['b', 'd', 'f']); // true

v::max(v::greaterThan(new DateTime('today')))
        ->isValid([new DateTime('yesterday'), new DateTime('tomorrow')]); // true

v::max(v::greaterThan(15))->isValid([4, 8, 12]); // false
```

## Note

This rule uses [Length](Length.md) with [GreaterThan][GreaterThan.md] internally. If an input has no items, the validation will fail.

## Templates

### `Max::TEMPLATE_STANDARD`

| Mode       | Template       |
| ---------- | -------------- |
| `default`  | The maximum of |
| `inverted` | The maximum of |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Comparisons
- Transformations

## Changelog

| Version | Description                 |
| ------: | --------------------------- |
|   3.0.0 | Became a transformation     |
|   2.0.0 | Became always inclusive     |
|   1.0.0 | Became inclusive by default |
|   0.3.9 | Created                     |

---

See also:

- [Between](Between.md)
- [BetweenExclusive](BetweenExclusive.md)
- [DateTimeDiff](DateTimeDiff.md)
- [Falsy](Falsy.md)
- [GreaterThan](GreaterThan.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [IterableType](IterableType.md)
- [Length](Length.md)
- [LessThan](LessThan.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Min](Min.md)
