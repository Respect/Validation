# Type

- `v::type(string $type)`

Validates the type of input.

```php
v::type('bool')->validate(true); // true
v::type('callable')->validate(function (){}); // true
v::type('object')->validate(new stdClass()); // true
```

***
See also:

  * [ArrayVal](ArrayVal.md)
  * [BoolType](BoolType.md)
  * [CallableType](CallableType.md)
  * [Finite](Finite.md)
  * [FloatType](FloatType.md)
  * [FloatVal](FloatVal.md)
  * [Infinite](Infinite.md)
  * [Instance](Instance.md)
  * [IntType](IntType.md)
  * [IntVal](IntVal.md)
  * [NullType](NullType.md)
  * [ObjectType](ObjectType.md)
  * [ResourceType](ResourceType.md)
  * [ScalarVal](ScalarVal.md)
  * [StringType](StringType.md)
  * [Type](Type.md)
