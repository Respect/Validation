# FloatVal

- `FloatVal()`

Validate whether the input value is float.

```php
use Respect\Validation\Validator as v;

v::floatVal()->validate(1.5); // true
v::floatVal()->validate('1e5'); // true
```

## Categorization

- Numbers
- Types

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [Type](Type.md)
