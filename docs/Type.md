# Type

- `Type(string $type)`

Validates the type of input.

```php
v::type('bool')->isValid(true); // true
v::type('callable')->isValid(function (){}); // true
v::type('object')->isValid(new stdClass()); // true
```

## Changelog

Version | Description
--------|-------------
  0.8.0 | Created

***
See also:

- [ArrayVal](ArrayVal.md)
- [BoolType](BoolType.md)
- [CallableType](CallableType.md)
- [Finite](Finite.md)
- [FloatType](FloatType.md)
- [FloatVal](FloatVal.md)
- [Infinite](Infinite.md)
- [Instance](Instance.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [NullType](NullType.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [ScalarVal](ScalarVal.md)
- [StringType](StringType.md)
- [Type](Type.md)
