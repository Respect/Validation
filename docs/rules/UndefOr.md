# UndefOr

- `UndefOr(Validatable $rule)`

Validates if the given input is undefined or not.

By _undefined_ we consider `null` or an empty string (`''`), which implies that the input is not set. This is particularly useful when validating form fields

```php
v::undefOr(v::alpha())->isValid(''); // true
v::undefOr(v::digit())->isValid(null); // true

v::undefOr(v::alpha())->isValid('username'); // true
v::undefOr(v::alpha())->isValid('has1number'); // false
```

## Note

For convenience, you can use the `undefOr` as a prefix to any rule:

```php
v::undefOrEmail()->isValid('not an email'); // false
v::undefOrBetween(1, 3)->isValid(2); // true
```

## Categorization

- Nesting

## Changelog

| Version | Description                          |
|--------:|--------------------------------------|
|   3.0.0 | Renamed from "Optional" to "UndefOr" |
|   1.0.0 | Created                              |

***
See also:

- [NoWhitespace](NoWhitespace.md)
- [NotBlank](NotBlank.md)
- [NotEmpty](NotEmpty.md)
- [NotUndef](NotUndef.md)
- [NullOr](NullOr.md)
- [NullType](NullType.md)
