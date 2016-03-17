# LeapDate

- `v::leapDate(string $format)`

Validates if a date is leap.

```php
v::leapDate('Y-m-d')->validate('1988-02-29'); // true
```

This validator accepts DateTime instances as well. The $format
parameter is mandatory.

***
See also:

  * [Date](Date.md)
  * [LeapYear](LeapYear.md)
