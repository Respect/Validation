# Nullable

- `Nullable(Validatable $rule)`

Validates the given input with a defined rule when input is not NULL.

```php
v::nullable(v::email())->validate(null); // true
v::nullable(v::email())->validate('example@example.com'); // true
v::nullable(v::email())->validate('not an email'); // false
```

## Categorization

- Nesting

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [NullType](NullType.md)
- [Optional](Optional.md)
