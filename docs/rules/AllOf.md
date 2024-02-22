# AllOf

- `AllOf(Validatable $rule1, Validatable $rule2, Validatable ...$rule)`

Will validate if all inner validators validates.

```php
v::allOf(v::intVal(), v::positive())->validate(15); // true
```

## Categorization

- Composite
- Nesting

## Changelog

Version | Description
--------|-------------
  3.0.0 | Require at least two rules to be passed
  0.3.9 | Created

***
See also:

- [AnyOf](AnyOf.md)
- [LazyConsecutive](LazyConsecutive.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
- [When](When.md)
