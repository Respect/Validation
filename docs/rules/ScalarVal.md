# ScalarVal

- `ScalarVal()`

Validates whether the input is a scalar value or not.

```php
use Respect\Validation\Validator as v;

v::scalarVal()->validate([]); // false
v::scalarVal()->validate(135.0); // true
```

## Categorization

- Types

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
