# MinimumAge

This is going to be deprecated, please use [Age](Age.md) instead.

- `v::minimumAge(int $age)`
- `v::minimumAge(int $age, string $format)`

Validates a minimum age for a given date.

```php
v::minimumAge(18)->validate('1987-01-01'); // true
v::minimumAge(18, 'd/m/Y')->validate('01/01/1987'); // true
```

Using `date()` before is a best-practice.

Message template for this validator includes `{{age}}`.

***
See also:

  * [Age](Age.md)
  * [Date](Date.md)
