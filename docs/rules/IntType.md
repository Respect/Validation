# IntType

- `v::intType()`

Validates whether the type of a value is integer.

```php
v::intType()->validate(42); // true
v::intType()->validate('10'); // false
```

***
See also:

  * [ArrayType](ArrayType.md)
  * [BoolType](BoolType.md)
  * [BoolVal](BoolVal.md)
  * [CallableType](CallableType.md)
  * [Digit](Digit.md)
  * [Finite](Finite.md)
  * [FloatType](FloatType.md)
  * [FloatVal](FloatVal.md)
  * [Infinite](Infinite.md)
  * [IntVal](IntVal.md)
  * [NullType](NullType.md)
  * [Numeric](Numeric.md)
  * [ObjectType](ObjectType.md)
  * [ResourceType](ResourceType.md)
  * [StringType](StringType.md)
  * [Type](Type.md)
