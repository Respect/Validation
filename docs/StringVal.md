# StringVal

- `StringVal()`

Validates whether the input can be used as a string.

```php
v::stringVal()->validate('6'); // true
v::stringVal()->validate('String'); // true
v::stringVal()->validate(1.0); // true
v::stringVal()->validate(42); // true
v::stringVal()->validate(false); // true
v::stringVal()->validate(true); // true
v::stringVal()->validate(new ClassWithToString()); // true if ClassWithToString implements `__toString`
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [Alnum](Alnum.md)
- [BoolType](BoolType.md)
- [CallableType](CallableType.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [NullType](NullType.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [Type](Type.md)
