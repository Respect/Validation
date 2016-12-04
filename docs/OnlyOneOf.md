# OnlyOneOf

- `v::onlyOneOf(v $v1, v $v2, v $v3...)`

Will validate if exactly one inner validator passes.

```php
v::onlyOneOf(
    v::xdigit(),
    v::negative(),
    v::positive()
)->validate(15); // true
```

In the sample above, `v::xdigit()` and `v::negative()` do not validate,
but `v::positive()` does as the only one.

`v::onlyOneOf()` returns true if exactly one inner validator passes.

***
See also:

  * [AllOf](AllOf.md)
  * [OneOf](OneOf.md)
  * [NoneOf](NoneOf.md)
