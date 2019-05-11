# BoolType

- `BoolType()`

Validates whether the type of the input is [boolean](http://php.net/types.boolean).

```php
v::boolType()->validate(true); // true
v::boolType()->validate(false); // true
```

## Categorization

- Booleans
- Types

## Changelog

Version | Description
--------|-------------
  1.0.0 | Renamed from `Bool` to `BoolType`
  0.3.9 | Created as `Bool`

***
See also:

- [ArrayType](ArrayType.md)
- [BoolVal](BoolVal.md)
- [CallableType](CallableType.md)
- [FloatType](FloatType.md)
- [FloatVal](FloatVal.md)
- [IntType](IntType.md)
- [No](No.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
- [TrueVal](TrueVal.md)
- [Type](Type.md)
- [Yes](Yes.md)
