# NotUndef

- `NotUndef()`

Validates if the given input is not optional. By _optional_ we consider `null`
or an empty string (`''`).

```php
use Respect\Validation\Validator as v;

v::notUndef()->validate(''); // false
v::notUndef()->validate(null); // false
```

Other values:

```php
use Respect\Validation\Validator as v;

v::notUndef()->validate([]); // true
v::notUndef()->validate(' '); // true
v::notUndef()->validate(0); // true
v::notUndef()->validate('0'); // true
v::notUndef()->validate(0); // true
v::notUndef()->validate('0.0'); // true
v::notUndef()->validate(false); // true
v::notUndef()->validate(['']); // true
v::notUndef()->validate([' ']); // true
v::notUndef()->validate([0]); // true
v::notUndef()->validate(['0']); // true
v::notUndef()->validate([false]); // true
v::notUndef()->validate([[''), [0]]); // true
v::notUndef()->validate(new stdClass()); // true
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
