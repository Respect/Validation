# Optional

- `v::optional(v $rule)`
- `v::optional(v $rule, array $optionalValues)`

Validates if the given input is optional or not. By _optional_ you may interpret
as `null` or an empty string (`''`).

```php
v::optional(v::alpha())->validate(''); // true
v::optional(v::digit())->validate(null); // true
```

Also you can defined what values you want as optional values:

```php
v::optional(v::alpha(), array(null))->validate(''); // false
```

The example bellow returns false because only `null` is accepted as optional
value, and `''` is not.

***
See also:

  * [NotEmpty](NotEmpty.md)
  * [NoWhitespace](NoWhitespace.md)
  * [NullType](NullType.md)
