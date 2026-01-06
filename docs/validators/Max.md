# Max

- `Max(Validator $validator)`

Validates the maximum value of the input against a given validator.

```php
v::max(v::equals(30))->assert([10, 20, 30]);
// Validation passes successfully

v::max(v::between('e', 'g'))->assert(['b', 'd', 'f']);
// Validation passes successfully

v::max(v::greaterThan(new DateTime('today')))
        ->assert([new DateTime('yesterday'), new DateTime('tomorrow')]);
// Validation passes successfully


v::max(v::greaterThan(15))->assert([4, 8, 12]);
// → The maximum of `[4, 8, 12]` must be greater than 15
```

## Note

This validator uses [Length](Length.md) with [GreaterThan][GreaterThan.md] internally. If an input has no items, the validation will fail.

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

- [All](All.md)
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
