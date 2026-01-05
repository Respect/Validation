# Min

- `Min(Validator $validator)`

Validates the minimum value of the input against a given validator.

```php
v::min(v::equals(10))->isValid([10, 20, 30]); // true

v::min(v::between('a', 'c'))->isValid(['b', 'd', 'f']); // true

v::min(v::greaterThan(new DateTime('yesterday')))
        ->isValid([new DateTime('today'), new DateTime('tomorrow')]); // true

v::min(v::lessThan(3))->isValid([4, 8, 12]); // false
```

## Note

This validator uses [Length](Length.md) with [GreaterThan][GreaterThan.md] internally. If an input has no items, the validation will fail.

## Templates

### `Min::TEMPLATE_STANDARD`

| Mode       | Template       |
| ---------- | -------------- |
| `default`  | The minimum of |
| `inverted` | The minimum of |

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

- [All](All.md)
- [Between](Between.md)
- [BetweenExclusive](BetweenExclusive.md)
- [DateTimeDiff](DateTimeDiff.md)
- [Each](Each.md)
- [Falsy](Falsy.md)
- [GreaterThan](GreaterThan.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [Length](Length.md)
- [LessThan](LessThan.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
