# NotUndef

- `NotUndef()`

Validates if the given input is not optional. By _optional_ we consider `null`
or an empty string (`''`).

```php
v::notUndef()->isValid(''); // false
v::notUndef()->isValid(null); // false
```

Other values:

```php
v::notUndef()->isValid([]); // true
v::notUndef()->isValid(' '); // true
v::notUndef()->isValid(0); // true
v::notUndef()->isValid('0'); // true
v::notUndef()->isValid(0); // true
v::notUndef()->isValid('0.0'); // true
v::notUndef()->isValid(false); // true
v::notUndef()->isValid(['']); // true
v::notUndef()->isValid([' ']); // true
v::notUndef()->isValid([0]); // true
v::notUndef()->isValid(['0']); // true
v::notUndef()->isValid([false]); // true
v::notUndef()->isValid([[''), [0]]); // true
v::notUndef()->isValid(new stdClass()); // true
```

## Categorization

- Miscellaneous

## Changelog

|  Version | Description                              |
|---------:|------------------------------------------|
|    3.0.0 | Renamed from "NotOptional" to "NotUndef" |
|    1.0.0 | Created                                  |

***
See also:

- [NoWhitespace](NoWhitespace.md)
- [NotBlank](NotBlank.md)
- [NotEmpty](NotEmpty.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [UndefOr](UndefOr.md)
