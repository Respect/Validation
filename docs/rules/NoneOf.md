# NoneOf

- `NoneOf(Rule $rule1, Rule $rule2, Rule ...$rule)`

Validates if NONE of the given validators validate:

```php
v::noneOf(
    v::intVal(),
    v::floatVal()
)->isValid('foo'); // true
```

In the sample above, 'foo' isn't a integer nor a float, so noneOf returns true.

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

- [AllOf](AllOf.md)
- [AnyOf](AnyOf.md)
- [Consecutive](Consecutive.md)
- [Not](Not.md)
- [OneOf](OneOf.md)
- [When](When.md)
