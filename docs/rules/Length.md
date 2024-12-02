# Length

- `Length(Validatable $rule)`

Validates the length of the given input against a given rule.

```php
v::length(v::between(1, 5))->isValid('abc'); // true

v::length(v::greaterThan(5))->isValid('abcdef'); // true

v::length(v::lessThan(5))->isValid('abc'); // true
```

This rule can be used to validate the length of strings, arrays, and objects that implement the `Countable` interface.

```php
v::length(v::greaterThanOrEqual(3))->isValid([1, 2, 3]); // true

v::length(v::equals(0))->isValid(new SplPriorityQueue()); // true
```

## Categorization

- Comparisons
- Transformations

## Changelog

| Version | Description             |
|--------:|-------------------------|
|   3.0.0 | Became a transformation |
|   0.3.9 | Created                 |

***
See also:

- [Between](Between.md)
- [BetweenExclusive](BetweenExclusive.md)
- [GreaterThan](GreaterThan.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [LessThan](LessThan.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
- [Min](Min.md)
