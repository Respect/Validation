# AllOf

- `AllOf(Rule $rule1, Rule $rule2, Rule ...$rule)`

Will validate if all inner validators validates.

```php
v::allOf(v::intVal(), v::positive())->isValid(15); // true
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
- [Consecutive](Consecutive.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
- [When](When.md)
