# FloatType

- `FloatType()`

Validates whether the type of a value is float.

```php
v::floatType()->validate(1.5); // true
v::floatType()->validate('1.5'); // false
v::floatType()->validate(0e5); // true
```

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [BoolType](BoolType.md)
- [CallableType](CallableType.md)
- [FloatVal](FloatVal.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [NumericVal](NumericVal.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [Type](Type.md)
