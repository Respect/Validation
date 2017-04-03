# Unique

- `Unique()`

Validates whether the input array contains only unique values.

```php
v::unique()->validate([]); // true
v::unique()->validate([1, 2, 3]); // true
v::unique()->validate([1, 2, 2, 3]); // false
v::unique()->validate([1, 2, 3, 1]); // false
```

***
See also:

- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [Contains](Contains.md)
- [Each](Each.md)
