# When

- `v::when(v $if, v $then, v $else)`
- `v::when(v $if, v $then)`

A ternary validator that accepts three parameters.

When the `$if` validates, returns validation for `$then`.
When the `$if` doesn't validate, returns validation for `$else`, if defined.

```php
v::when(v::intVal(), v::positive(), v::notEmpty())->validate($input);
```

In the sample above, if `$input` is an integer, then it must be positive.
If `$input` is not an integer, then it must not me empty.
When `$else` is not defined use [AlwaysInvalid](AlwaysInvalid.md)

***
See also:

  * [AllOf](AllOf.md)
  * [AlwaysInvalid](AlwaysInvalid.md)
  * [NoneOf](NoneOf.md)
  * [OneOf](OneOf.md)
