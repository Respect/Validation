# UndefOr

- `UndefOr(Validatable $rule)`

Validates if the given input is undefined or not.

By _undefined_ we consider `null` or an empty string (`''`), which implies that the input is not set. This is particularly useful when validating form fields

```php
v::undefOr(v::alpha())->validate(''); // true
v::undefOr(v::digit())->validate(null); // true

v::undefOr(v::alpha())->validate('username'); // true
v::undefOr(v::alpha())->validate('has1number'); // false
```

## Note

For convenience, you can use the `undefOr` as a prefix to any rule:

```php
v::undefOrEmail()->validate('not an email'); // false
v::undefOrBetween(1, 3)->validate(2); // true
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
- [NullType](NullType.md)
- [Nullable](Nullable.md)
