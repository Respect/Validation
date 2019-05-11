# Unique

- `Unique()`

Validates whether the input array contains only unique values.

```php
v::unique()->validate([]); // true
v::unique()->validate([1, 2, 3]); // true
v::unique()->validate([1, 2, 2, 3]); // false
v::unique()->validate([1, 2, 3, 1]); // false
```

## Categorization

- Arrays

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [Contains](Contains.md)
- [Each](Each.md)
