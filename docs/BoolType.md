# BoolType

- `BoolType()`

Validates if the input is a boolean value:

```php
v::boolType()->validate(true); // true
v::boolType()->validate(false); // true
```

## Changelog

Version | Description
--------|-------------
  1.0.0 | Renamed from `Bool` to `BoolType`
  0.3.9 | Created as `Bool`

***
See also:

- [ArrayType](ArrayType.md)
- [CallableType](CallableType.md)
- [FloatType](FloatType.md)
- [FloatVal](FloatVal.md)
- [IntType](IntType.md)
- [No](No.md)
- [NullType](NullType.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [TrueVal](TrueVal.md)
- [Type](Type.md)
- [Yes](Yes.md)
