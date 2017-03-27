# NoneOf

- `NoneOf(Validatable ...$rule)`

Validates if NONE of the given validators validate:

```php
v::noneOf(
    v::intVal(),
    v::floatVal()
)->validate('foo'); // true
```

In the sample above, 'foo' isn't a integer nor a float, so noneOf returns true.

***
See also:

  * [AllOf](AllOf.md)
  * [AnyOf](AnyOf.md)
  * [Not](Not.md)
  * [OneOf](OneOf.md)
