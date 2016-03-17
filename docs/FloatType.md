# FloatType

- `v::floatType()`

Validates whether the type of a value is float.

```php
v::floatType()->validate(1.5); // true
v::floatType()->validate('1.5'); // false
v::floatType()->validate(0e5); // true
```

***
See also:

  * [BoolType](BoolType.md)
  * [CallableType](CallableType.md)
  * [FloatVal](FloatVal.md)
  * [IntType](IntType.md)
  * [IntVal](IntVal.md)
  * [NullType](NullType.md)
  * [ObjectType](ObjectType.md)
  * [ResourceType](ResourceType.md)
  * [StringType](StringType.md)
  * [Type](Type.md)
