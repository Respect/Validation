# CallableType

- `CallableType()`

Validates if the input is a callable value.

```php
v::callableType()->validate(function () {}); // true
v::callableType()->validate('trim'); // true
v::callableType()->validate([new ObjectType, 'methodName']); // true
```

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [ArrayType](ArrayType.md)
- [BoolType](BoolType.md)
- [Callback](Callback.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [NullType](NullType.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [Type](Type.md)
