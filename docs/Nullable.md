# Nullable

- `v::nullable(v $rule)`

Validates if the given input is nullable or not.

```php
v::nullable(v::alpha())->validate(''); // false
v::nullable(v::digit())->validate(null); // true
```


***
See also:

  * [Optional](Optional.md)
  * [NullType](NullType.md)
