# LeapDate

- `LeapDate(string $format)`

Validates if a date is leap.

```php
use Respect\Validation\Validator as v;

v::leapDate('Y-m-d')->validate('1988-02-29'); // true
```

This validator accepts DateTime instances as well. The $format
parameter is mandatory.

## Categorization

- Date and Time

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Date](Date.md)
- [DateTime](DateTime.md)
- [LeapYear](LeapYear.md)
- [Time](Time.md)
