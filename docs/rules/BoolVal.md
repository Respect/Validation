# BoolVal

- `BoolVal()`

Validates if the input results in a boolean value:

```php
v::boolVal()->isValid('on'); // true
v::boolVal()->isValid('off'); // true
v::boolVal()->isValid('yes'); // true
v::boolVal()->isValid('no'); // true
v::boolVal()->isValid(1); // true
v::boolVal()->isValid(0); // true
```

## Categorization

- Booleans
- Types

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [BoolType](BoolType.md)
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
