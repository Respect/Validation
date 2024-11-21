# AnyOf

- `AnyOf(Validatable $rule1, Validatable $rule2, Validatable ...$rule)`

This is a group validator that acts as an OR operator.

```php
use Respect\Validation\Validator as v;

v::anyOf(v::intVal(), v::floatVal())->validate(15.5); // true
```

In the sample above, `IntVal()` doesn't validates, but `FloatVal()` validates,
so `AnyOf()` returns true.

`AnyOf()` returns true if at least one inner validator passes.

## Categorization

- Composite
- Nesting

## Changelog

Version | Description
--------|-------------
  3.0.0 | Require at least two rules to be passed
  2.0.0 | Created

***
See also:

- [AllOf](AllOf.md)
- [Consecutive](Consecutive.md)
- [ContainsAny](ContainsAny.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
- [When](When.md)
