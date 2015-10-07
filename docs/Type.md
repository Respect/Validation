# Type

- `v::type(string $type)`

Validates the type of input.

```php
v::type('bool')->validate(true); //true
v::type('callable')->validate(function (){}); //true
v::type('object')->validate(new stdClass()); //true
```

***
See also:

  * [ArrayVal](ArrayVal.md)
  * [BoolType](BoolType.md)
  * [CallableType](CallableType.md)
  * [Finite](Finite.md)
  * [FloatVal](FloatVal.md)
  * [Infinite](Infinite.md)
  * [Instance](Instance.md)
  * [IntVal](IntVal.md)
  * [ObjectType](ObjectType.md)
  * [ResourceType](ResourceType.md)
  * [Scalar](Scalar.md)
  * [StringType](StringType.md)
