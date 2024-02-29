# Min

- `Min(Validatable $rule)`

Validates the minimum value of the input against a given rule.

```php
v::min(v::equals(10))->validate([10, 20, 30]); // true

v::min(v::between('a', 'c'))->validate(['b', 'd', 'f']); // true

v::min(v::greaterThan(new DateTime('yesterday')))
        ->validate([new DateTime('today'), new DateTime('tomorrow')]); // true

v::min(v::lessThan(3))->validate([4, 8, 12]); // false
```

## Note

This rule uses PHP's [min][] function to compare the input against the given rule. The PHP manual states that:

> Values of different types will be compared using the [standard comparison rules][]. For instance, a non-numeric
> `string` will be compared to an `int` as though it were `0`, but multiple non-numeric `string` values will be compared
> alphanumerically. The actual value returned will be of the original type with no conversion applied.

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
- [GreaterThan](GreaterThan.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [LessThan](LessThan.md)
- [LessThanOrEqual](LessThanOrEqual.md)

[min]: https://www.php.net/min
[standard comparison rules]: https://www.php.net/operators.comparison
