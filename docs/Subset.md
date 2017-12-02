# Subset

- `Subset(array $superset)`

Validates whether the input is a subset of a given value.

```php
v::subset([1, 2, 3])->validate([1, 2]); // true
v::subset([1, 2])->validate([1, 2, 3]); // false
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [ArrayVal](ArrayVal.md)
- [ArrayType](ArrayType.md)
