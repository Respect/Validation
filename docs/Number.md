# Number

- `Number()`

Validates if the input is a number.

```php
v::number()->validate(42); // true
v::number()->validate(acos(8)); // false
```

> "In computing, NaN, standing for not a number, is a numeric data type value
> representing an undefined or unrepresentable value, especially in
> floating-point calculations." [Wikipedia](https://en.wikipedia.org/wiki/NaN)

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

  * [BoolType](BoolType.md)
  * [CallableType](CallableType.md)
  * [FloatType](FloatType.md)
  * [IntType](IntType.md)
  * [NotBlank](NotBlank.md)
  * [NotEmpty](NotEmpty.md)
  * [NotOptional](NotOptional.md)
  * [NullType](NullType.md)
  * [ObjectType](ObjectType.md)
  * [ResourceType](ResourceType.md)
  * [StringType](StringType.md)
  * [Type](Type.md)
