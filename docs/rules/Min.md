# Min

- `Min(Validatable $rule)`

Validates the minimum value of the input against a given rule.

```php
use Respect\Validation\Validator as v;

v::min(v::equals(10))->validate([10, 20, 30]); // true

v::min(v::between('a', 'c'))->validate(['b', 'd', 'f']); // true

v::min(v::greaterThan(new DateTime('yesterday')))
        ->validate([new DateTime('today'), new DateTime('tomorrow')]); // true

v::min(v::lessThan(3))->validate([4, 8, 12]); // false
```

## Note

This rule uses [IterableType](IterableType.md) and [NotEmpty](NotEmpty.md) internally. If an input is non-iterable or
empty, the validation will fail.

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
- [Each](Each.md)
- [GreaterThan](GreaterThan.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [Length](Length.md)
- [LessThan](LessThan.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
- [NotEmpty](NotEmpty.md)
