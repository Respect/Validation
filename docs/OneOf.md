# OneOf

- `v::oneOf(v $v1, v $v2, v $v3...)`

This is a group validator that acts as an OR operator.

```php
v::oneOf(
    v::int(),
    v::float()
)->validate(15.5); //true
```

In the sample above, `v::int()` doesn't validates, but
`v::float()` validates, so oneOf returns true.

`v::oneOf` returns true if at least one inner validator
passes.

Using a shortcut

```php
v::int()->addOr(v::float())->validate(15.5); //true
```

See also:

  * [AllOf](AllOf.md)
  * [NoneOf](NoneOf.md)
  * [When](When.md)
