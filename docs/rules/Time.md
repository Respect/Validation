# Time

- `Time()`
- `Time(string $format)`

Validates whether an input is a time or not. The `$format` argument should be in
accordance to PHP's [date()](http://php.net/date) function, but only those are
allowed:

Format  | Description                                        | Values
--------|----------------------------------------------------|--------
`g`     | 12-hour format of an hour without leading zeros    | 1 through 12
`G`     | 24-hour format of an hour without leading zeros    | 0 through 23
`h`     | 12-hour format of an hour with leading zeros       | 01 through 12
`H`     | 24-hour format of an hour with leading zeros       | 00 through 23
`i`     | Minutes with leading zeros                         | 00 to 59
`s`     | Seconds, with leading zeros                        | 00 through 59
`u`     | Microseconds                                       | 000000 through 999999
`v`     | Milliseconds                                       | 000 through 999
`a`     | Lowercase Ante meridiem and Post meridiem          | am or pm
`A`     | Uppercase Ante meridiem and Post meridiem          | AM or PM

When a `$format` is not given its default value is `H:i:s`. 

```php
v::time()->validate('00:00:00'); // true
v::time()->validate('23:20:59'); // true
v::time('H:i')->validate('23:59'); // true
v::time('g:i A')->validate('8:13 AM'); // true
v::time('His')->validate(232059); // true

v::time()->validate('24:00:00'); // false
v::time()->validate(new DateTime()); // false
v::time()->validate(new DateTimeImmutable()); // false
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [Date](Date.md)
- [DateTime](DateTime.md)
- [LeapDate](LeapDate.md)
- [LeapYear](LeapYear.md)
