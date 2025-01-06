# Optional

- `Optional(Validatable $rule)`

Validates if the given input is optional or not. By _optional_ we consider `null`
or an empty string (`''`).

```php
v::optional(v::alpha())->isValid(''); // true
v::optional(v::digit())->isValid(null); // true
```

## Categorization

- Nesting

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [NoWhitespace](NoWhitespace.md)
- [NotBlank](NotBlank.md)
- [NotEmpty](NotEmpty.md)
- [NotOptional](NotOptional.md)
- [NullType](NullType.md)
- [Nullable](Nullable.md)
