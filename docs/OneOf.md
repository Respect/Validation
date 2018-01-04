# OneOf

- `OneOf(Rule ...$rule)`

Will validate if exactly one inner validator passes.

```php
v::oneOf(v::digit(), v::alpha())->isValid('AB'); // true
v::oneOf(v::digit(), v::alpha())->isValid('12'); // true
v::oneOf(v::digit(), v::alpha())->isValid('AB12'); // false
v::oneOf(v::digit(), v::alpha())->isValid('*'); // false
```

The chains above validate if the input is either a digit or an alphabetic
character, one or the other, but not neither nor both.

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created (see [AnyOf](AnyOf.md))

***
See also:

- [AllOf](AllOf.md)
- [AnyOf](AnyOf.md)
- [NoneOf](NoneOf.md)
