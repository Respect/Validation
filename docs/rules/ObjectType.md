# ObjectType

- `ObjectType()`

Validates whether the input is an [object](http://php.net/types.object).

```php
use Respect\Validation\Validator as v;

v::objectType()->validate(new stdClass); // true
```

## Categorization

- Objects
- Types

## Changelog

Version | Description
--------|-------------
  1.0.0 | Renamed from `Object` to `ObjectType`
  0.3.9 | Created as `Object`

***
See also:

- [ArrayType](ArrayType.md)
- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [CallableType](CallableType.md)
- [FloatType](FloatType.md)
- [Instance](Instance.md)
- [IntType](IntType.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [Property](Property.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
- [Type](Type.md)
