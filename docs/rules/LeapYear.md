# LeapYear

- `LeapYear()`

Validates if a year is leap.

```php
v::leapYear()->isValid('1988'); // true
```

This validator accepts DateTime instances as well.

## Templates

`LeapYear::TEMPLATE_STANDARD`

| Mode       | Template                           |
|------------|------------------------------------|
| `default`  | {{name}} must be a valid leap year |
| `inverted` | {{name}} must not be a leap year   |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Date and Time

## Changelog

| Version | Description |
|--------:|-------------|
|   0.3.9 | Created     |

***
See also:

- [Date](Date.md)
- [DateTime](DateTime.md)
- [LeapDate](LeapDate.md)
- [Time](Time.md)
