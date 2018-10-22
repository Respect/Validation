# ContainsAny

- `ContainsAny(array $needles)`
- `ContainsAny(array $needles, bool $strictCompareArray)`

Validates if the input contains at least one of presented values.

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

Message template for this validator includes `{{containsValue}}`.

## Changelog

Version | Description
--------|-------------
 1.1.19 | Created

***
See also:

- [Contains](Contains.md)
- [Equivalent](Equivalent.md)
- [In](In.md)
