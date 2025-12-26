# LeapDate

- `LeapDate(string $format)`

Validates if a date is leap.

```php
v::leapDate('Y-m-d')->isValid('1988-02-29'); // true
```

This validator accepts DateTime instances as well. The $format
parameter is mandatory.

## Templates

### `LeapDate::TEMPLATE_STANDARD`

| Mode       | Template                              |
| ---------- | ------------------------------------- |
| `default`  | {{subject}} must be a valid leap date |
| `inverted` | {{subject}} must not be a leap date   |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Date and Time

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.3.9 | Created     |

---

See also:

- [Date](Date.md)
- [DateTime](DateTime.md)
- [LeapYear](LeapYear.md)
- [Time](Time.md)
