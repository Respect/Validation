# NoneOf

- `v::noneOf(v $v1, v $v2, v $v3...)`

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
  * [Not](Not.md)
  * [OneOf](OneOf.md)
  * [When](When.md)
