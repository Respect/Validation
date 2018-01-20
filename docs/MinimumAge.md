# MinimumAge

This is going to be deprecated, please use [Age](Age.md) instead.

- `MinimumAge(int $age)`
- `MinimumAge(int $age, string $format)`

Validates a minimum age for a given date.

```php
v::minimumAge(18)->validate('1987-01-01'); // true
v::minimumAge(18, 'd/m/Y')->validate('01/01/1987'); // true
```

Using [DateTime](DateTime.md) before is a best-practice.

Message template for this validator includes `{{age}}`.

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Age](Age.md)
- [DateTime](DateTime.md)
