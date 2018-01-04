# DateTime

- `DateTime()`
- `DateTime(string $format)`

Validates if input is a date. The `$format` argument should be in accordance to
PHP's [date()](http://php.net/date) function.

```php
v::dateTime()->isValid('2009-01-01'); // true
```

Also accepts strtotime values:

```php
v::dateTime()->isValid('now'); // true
```

And `DateTimeInterface` instances:

```php
v::dateTime()->isValid(new DateTime()); // true
v::dateTime()->isValid(new DateTimeImmutable()); // true
```

You can pass a format when validating strings:

```php
v::dateTime('Y-m-d')->isValid('01-01-2009'); // false
```

Format has no effect when validating DateTime instances.

Message template for this validator includes `{{format}}`.

## Changelog

Version | Description
--------|-------------
  2.0.0 | Renamed from `Date` to `DateTime`
  0.3.9 | Created as `Date`

***
See also:

- [Between](Between.md)
- [MinimumAge](MinimumAge.md)
- [LeapDate](LeapDate.md)
- [LeapYear](LeapYear.md)
