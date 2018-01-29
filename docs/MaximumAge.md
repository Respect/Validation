# MaximumAge

- `MaximumAge(int $age)`
- `MaximumAge(int $age, string $format)`

Validates a maximum age for a given date. The `$format` argument should be in
accordance to PHP's [date()][] function. When `$format` is not  given this rule
accepts [Supported Date and Time Formats][] by PHP (see [strtotime()][]).

```php
v::maximumAge(12)->validate('12 years ago'); // true
v::maximumAge(12, 'Y-m-d')->validate('2013-07-31'); // true

v::maximumAge(12)->validate('13 years ago'); // false
v::maximumAge(18, 'Y-m-d')->validate('1988-09-09'); // false
```

Using [Date](Date.md) before is a best-practice.
This rule does not accepts instances of [DateTimeInterface][].

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created based on removed `Age` rule

***
See also:

- [Date](Date.md)
- [Max](Max.md)
- [Min](Min.md)
- [MinimumAge](MinimumAge.md)

[date()]: http://php.net/date
[DateTimeInterface]: http://php.net/DateTimeInterface
[strtotime()]: http://php.net/strtotime
[Supported Date and Time Formats]: http://php.net/datetime.formats
