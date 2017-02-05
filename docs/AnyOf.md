# AnyOf

- `v::anyOf(v $v1, v $v2, v $v3...)`

This is a group validator that acts as an OR operator.

```php
v::anyOf(
    v::intVal(),
    v::floatVal()
)->validate(15.5); // true
```

In the sample above, `v::intVal()` doesn't validates, but
`v::floatVal()` validates, so anyOf returns true.

`v::anyOf` returns true if at least one inner validator
passes.

***
See also:

  * [AllOf](AllOf.md)
  * [NoneOf](NoneOf.md)
  * [When](When.md)
