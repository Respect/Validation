# ResourceType

- `ResourceType()`

Validates whether the input is a [resource](http://php.net/types.resource).

```php
v::resourceType()->validate(fopen('/path/to/file.txt', 'w')); // true
```

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [BoolType](BoolType.md)
- [CallableType](CallableType.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [NullType](NullType.md)
- [ObjectType](ObjectType.md)
- [StringType](StringType.md)
- [Type](Type.md)
