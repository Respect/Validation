# ArrayType

- `v::arrayType()`

Validates whether the type of an input is array.

```php
v::arrayType()->validate([]); // true
v::arrayType()->validate([1, 2, 3]); // true
v::arrayType()->validate(new ArrayObject()); // false
```

***
See also:

  * [ArrayVal](ArrayVal.md)
  * [BoolType](BoolType.md)
  * [CallableType](CallableType.md)
  * [Countable](Countable.md)
  * [FloatType](FloatType.md)
  * [IntType](IntType.md)
  * [IterableType](IterableType.md)
  * [NullType](NullType.md)
  * [ObjectType](ObjectType.md)
  * [ResourceType](ResourceType.md)
  * [StringType](StringType.md)
  * [Type](Type.md)
