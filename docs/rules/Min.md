# Min

- `Min(Rule $rule)`

Validates the minimum value of the input against a given rule.

```php
v::min(v::equals(10))->isValid([10, 20, 30]); // true

v::min(v::between('a', 'c'))->isValid(['b', 'd', 'f']); // true

v::min(v::greaterThan(new DateTime('yesterday')))
        ->isValid([new DateTime('today'), new DateTime('tomorrow')]); // true

v::min(v::lessThan(3))->isValid([4, 8, 12]); // false
```

## Note

This rule uses [IterableType](IterableType.md) and [NotEmpty](NotEmpty.md) internally. If an input is non-iterable or
empty, the validation will fail.

## Templates

### `Min::TEMPLATE_STANDARD`

| Mode       | Template         |
|------------|------------------|
| `default`  | The minimum of |
| `inverted` | The minimum of |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Comparisons
- Transformations

## Changelog

| Version | Description                 |
|--------:|-----------------------------|
|   3.0.0 | Became a transformation     |
|   2.0.0 | Became always inclusive     |
|   1.0.0 | Became inclusive by default |
|   0.3.9 | Created                     |

***
See also:

- [Between](Between.md)
- [BetweenExclusive](BetweenExclusive.md)
- [DateTimeDiff](DateTimeDiff.md)
- [Each](Each.md)
- [GreaterThan](GreaterThan.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [Length](Length.md)
- [LessThan](LessThan.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
- [NotEmpty](NotEmpty.md)
