# OneOf

- `v::oneOf(v $v1, v $v2, v $v3...)`

This is a group validator that acts as an OR operator.

```php
v::oneOf(
    v::intVal(),
    v::floatVal()
)->validate(15.5); // true
```

In the sample above, `v::intVal()` doesn't validates, but
`v::floatVal()` validates, so oneOf returns true.

`v::oneOf` returns true if at least one inner validator
passes.

***
See also:

  * [AllOf](AllOf.md)
  * [NoneOf](NoneOf.md)
  * [When](When.md)
