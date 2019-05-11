# Type

- `Type(string $type)`

Validates the type of input.

```php
v::type('bool')->validate(true); // true
v::type('callable')->validate(function (){}); // true
v::type('object')->validate(new stdClass()); // true
```

## Categorization

- Types

## Changelog

Version | Description
--------|-------------
  2.0.0 | Became case-sensitive
  0.8.0 | Created

***
See also:

- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [CallableType](CallableType.md)
- [Finite](Finite.md)
- [FloatType](FloatType.md)
- [FloatVal](FloatVal.md)
- [Infinite](Infinite.md)
- [Instance](Instance.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [ScalarVal](ScalarVal.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
