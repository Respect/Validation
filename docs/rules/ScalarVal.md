# ScalarVal

- `ScalarVal()`

Validates whether the input is a scalar value or not.

```php
v::scalarVal()->validate([]); // false
v::scalarVal()->validate(135.0); // true
```

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [ArrayVal](ArrayVal.md)
- [NumericVal](NumericVal.md)
- [StringType](StringType.md)
- [Type](Type.md)
