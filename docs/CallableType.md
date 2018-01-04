# CallableType

- `CallableType()`

Validates if the input is a callable value.

```php
v::callableType()->isValid(function () {}); // true
v::callableType()->isValid('trim'); // true
v::callableType()->isValid([new ObjectType, 'methodName']); // true
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
