# ScalarVal

- `ScalarVal()`

Validates if the input is a scalar value.

```php
v::scalarVal()->isValid([]); // false
v::scalarVal()->isValid(135.0); // true
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
