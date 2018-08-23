# Date

- `Date()`
- `Date(string $format)`

Validates if input is a date. The `$format` argument should be in accordance to
PHP's [date()](http://php.net/date) function, but only those are allowed:

Format  | Description                                                           | Values
--------|-----------------------------------------------------------------------|-------------------------
`d`     | Day of the month, 2 digits with leading zeros                         | 01 to 31
`j`     | Day of the month without leading zeros                                | 1 to 31
`S`     | English ordinal suffix for the day of the month, 2 characters         | st, nd, rd or th
`F`     | A full textual representation of a month, such as January or March    | January to December
`m`     | Numeric representation of a month, with leading zeros                 | 01 to 12
`M`     | A short textual representation of a month, three letters              | Jan to Dec
`n`     | Numeric representation of a month, without leading zeros              | 1 to 12
`Y`     | A full numeric representation of a year, 4 digits                     | Examples: 1988 or 2017
`y`     | A two digit representation of a year                                  | Examples: 88 or 17


When a `$format` is not given its default value is `Y-m-d`. 

```php
v::date()->validate('2017-12-31'); // true
v::date()->validate('2020-02-29'); // true
v::date()->validate('2019-02-29'); // false
v::date('m/d/y')->validate('12/31/17'); // true
v::date('F jS, Y')->validate('May 1st, 2017'); // true
v::date('Ydm')->validate(20173112); // true
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [DateTime](DateTime.md)
- [MinAge](MinAge.md)
- [LeapDate](LeapDate.md)
- [LeapYear](LeapYear.md)
- [Time](Time.md)
