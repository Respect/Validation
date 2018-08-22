# BoolVal

- `v::boolVal()`

Validates if the input results in a boolean value:

```php
v::boolVal()->validate('on'); // true
v::boolVal()->validate('off'); // true
v::boolVal()->validate('yes'); // true
v::boolVal()->validate('no'); // true
v::boolVal()->validate(1); // true
v::boolVal()->validate(0); // true
```

***
See also:

  * [BoolType](BoolType.md)
  * [CallableType](CallableType.md)
  * [FloatType](FloatType.md)
  * [FloatVal](FloatVal.md)
  * [IntType](IntType.md)
  * [No](No.md)
  * [NullType](NullType.md)
  * [ObjectType](ObjectType.md)
  * [ResourceType](ResourceType.md)
  * [StringType](StringType.md)
  * [TrueVal](TrueVal.md)
  * [Type](Type.md)
  * [Yes](Yes.md)
