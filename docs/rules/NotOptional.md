# NotOptional

- `NotOptional()`

Validates if the given input is not optional. By _optional_ we consider `null`
or an empty string (`''`).

```php
v::notOptional()->isValid(''); // false
v::notOptional()->isValid(null); // false
```

Other values:

```php
v::notOptional()->isValid([]); // true
v::notOptional()->isValid(' '); // true
v::notOptional()->isValid(0); // true
v::notOptional()->isValid('0'); // true
v::notOptional()->isValid(0); // true
v::notOptional()->isValid('0.0'); // true
v::notOptional()->isValid(false); // true
v::notOptional()->isValid(['']); // true
v::notOptional()->isValid([' ']); // true
v::notOptional()->isValid([0]); // true
v::notOptional()->isValid(['0']); // true
v::notOptional()->isValid([false]); // true
v::notOptional()->isValid([[''), [0]]); // true
v::notOptional()->isValid(new stdClass()); // true
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
