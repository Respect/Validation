# ContainsAny

- `ContainsAny(array $needles)`
- `ContainsAny(array $needles, bool $identical)`

Validates if the input contains at least one of defined values

For strings (comparing is case insensitive):

```php
v::containsAny(['lorem', 'dolor'])->validate('lorem ipsum'); // true
```

For arrays (comparing is case sensitive to respect "contains" behavior):

```php
v::containsAny(['lorem', 'dolor'])->validate(['ipsum', 'lorem']); // true
```

A second parameter may be passed for identical comparison instead
of equal comparison for arrays.

Message template for this validator includes `{{needles}}`.

## Categorization

- Arrays
- Strings

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [AnyOf](AnyOf.md)
- [Contains](Contains.md)
- [Equivalent](Equivalent.md)
- [In](In.md)
