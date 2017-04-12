# When

- `When(Validatable $if, Validatable $then)`
- `When(Validatable $if, Validatable $then, Validatable $else)`

A ternary validator that accepts three parameters.

When the `$if` validates, returns validation for `$then`.
When the `$if` doesn't validate, returns validation for `$else`, if defined.

```php
v::when(v::intVal(), v::positive(), v::notEmpty())->validate($input);
```

In the sample above, if `$input` is an integer, then it must be positive.
If `$input` is not an integer, then it must not me empty.
When `$else` is not defined use [AlwaysInvalid](AlwaysInvalid.md)

## Changelog

Version | Description
--------|-------------
  0.8.0 | Allow to use rule without else
  0.3.9 | Created

***
See also:

- [AllOf](AllOf.md)
- [OneOf](OneOf.md)
- [NoneOf](NoneOf.md)
