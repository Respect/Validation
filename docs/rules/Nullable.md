# Nullable

- `Nullable(Validatable $rule)`

Validates the given input with a defined rule when input is not NULL.

```php
v::nullable(v::email())->isValid(null); // true
v::nullable(v::email())->isValid('example@example.com'); // true
v::nullable(v::email())->isValid('not an email'); // false
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

  * [Optional](Optional.md)
  * [NullType](NullType.md)
