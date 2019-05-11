# NotOptional

- `NotOptional()`

Validates if the given input is not optional. By _optional_ we consider `null`
or an empty string (`''`).

```php
v::notOptional()->validate(''); // false
v::notOptional()->validate(null); // false
```

Other values:

```php
v::notOptional()->validate([]); // true
v::notOptional()->validate(' '); // true
v::notOptional()->validate(0); // true
v::notOptional()->validate('0'); // true
v::notOptional()->validate(0); // true
v::notOptional()->validate('0.0'); // true
v::notOptional()->validate(false); // true
v::notOptional()->validate(['']); // true
v::notOptional()->validate([' ']); // true
v::notOptional()->validate([0]); // true
v::notOptional()->validate(['0']); // true
v::notOptional()->validate([false]); // true
v::notOptional()->validate([[''), [0]]); // true
v::notOptional()->validate(new stdClass()); // true
```

## Categorization

- Miscellaneous

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [NoWhitespace](NoWhitespace.md)
- [NotBlank](NotBlank.md)
- [NotEmpty](NotEmpty.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [Optional](Optional.md)
