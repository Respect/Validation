# ResourceType

- `ResourceType()`

Validates whether the input is a [resource](http://php.net/types.resource).

```php
v::resourceType()->validate(fopen('/path/to/file.txt', 'w')); // true
```

## Categorization

- Types

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [ArrayType](ArrayType.md)
- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [CallableType](CallableType.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [ObjectType](ObjectType.md)
- [PhpLabel](PhpLabel.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
- [Type](Type.md)
