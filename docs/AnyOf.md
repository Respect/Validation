# AnyOf

- `AnyOf(Validatable ...$rule)`

This is a group validator that acts as an OR operator.

```php
v::anyOf(
    v::intVal(),
    v::floatVal()
)->validate(15.5); // true
```

In the sample above, `IntVal()` doesn't validates, but `FloatVal()` validates,
so `AnyOf()` returns true.

`AnyOf()` returns true if at least one inner validator passes.

## Changelog

Version | Description
--------|-------------
  2.0.0 | Renamed from `OneOf` to `AnyOf`
  0.3.9 | Created

***
See also:

- [AllOf](AllOf.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
- [When](When.md)
