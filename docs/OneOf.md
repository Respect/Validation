# OneOf

- `v::oneOf(v $v1, v $v2, v $v3...)`

Will validate if exactly one inner validator passes.

```php
v::oneOf(v::digit(), v::alpha())->validate('AB'); // true
v::oneOf(v::digit(), v::alpha())->validate('12'); // true
v::oneOf(v::digit(), v::alpha())->validate('AB12'); // false
v::oneOf(v::digit(), v::alpha())->validate('*'); // false
```

The chains above validate if the input is either a digit or an alphabetic
character, one or the other, but not neither nor both.

***
See also:

  * [AllOf](AllOf.md)
  * [AnyOf](AnyOf.md)
  * [NoneOf](NoneOf.md)
