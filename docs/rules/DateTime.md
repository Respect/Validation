# DateTime

- `DateTime()`
- `DateTime(string $format)`

Validates whether an input is a date/time or not. The `$format` argument should
be in accordance to PHP's [date()](http://php.net/date) function.

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

## Categorization

- Date and Time

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [Between](Between.md)
- [Date](Date.md)
- [LeapDate](LeapDate.md)
- [LeapYear](LeapYear.md)
- [MinAge](MinAge.md)
- [Time](Time.md)
