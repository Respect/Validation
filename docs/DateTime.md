# DateTime

- `DateTime()`
- `DateTime(string $format)`

Validates if input is a date. The `$format` argument should be in accordance to
PHP's [date()](http://php.net/date) function.

```php
v::dateTime()->validate('2009-01-01'); // true
```

Also accepts strtotime values:

```php
v::dateTime()->validate('now'); // true
```

And `DateTimeInterface` instances:

```php
v::dateTime()->validate(new DateTime()); // true
v::dateTime()->validate(new DateTimeImmutable()); // true
```

You can pass a format when validating strings:

```php
v::dateTime('Y-m-d')->validate('01-01-2009'); // false
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
