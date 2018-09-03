# MinAge

- `MinAge(int $age)`
- `MinAge(int $age, string $format)`

Validates a minimum age for a given date. The `$format` argument should be in
accordance to PHP's [date()][] function. When `$format` is not  given this rule
accepts [Supported Date and Time Formats][] by PHP (see [strtotime()][]).

```php
v::minAge(18)->isValid('18 years ago'); // true
v::minAge(18, 'Y-m-d')->isValid('1987-01-01'); // true

v::minAge(18)->isValid('17 years ago'); // false
v::minAge(18, 'Y-m-d')->isValid('2010-09-07'); // false
```

Using [Date](Date.md) before is a best-practice.
This rule does not accepts instances of [DateTimeInterface][].

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Date](Date.md)
- [Max](Max.md)
- [MaxAge](MaxAge.md)
- [Min](Min.md)

[date()]: http://php.net/date
[DateTimeInterface]: http://php.net/DateTimeInterface
[strtotime()]: http://php.net/strtotime
[Supported Date and Time Formats]: http://php.net/datetime.formats
