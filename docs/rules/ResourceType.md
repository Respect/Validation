# ResourceType

- `v::resourceType()`

Validates if the input is a resource.

```php
v::resourceType()->validate(fopen('/path/to/file.txt', 'w')); // true
```

***
See also:

  * [ArrayType](ArrayType.md)
  * [BoolType](BoolType.md)
  * [BoolVal](BoolVal.md)
  * [CallableType](CallableType.md)
  * [FloatType](FloatType.md)
  * [IntType](IntType.md)
  * [NullType](NullType.md)
  * [ObjectType](ObjectType.md)
  * [PhpLabel](PhpLabel.md)
  * [StringType](StringType.md)
  * [Type](Type.md)
