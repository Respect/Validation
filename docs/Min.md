# Min

- `Min(mixed $compareTo)`

Validates whether the input is greater than or equal to a value.

```php
v::intVal()->min(10)->validate(9); // false
v::intVal()->min(10)->validate(10); // true
v::intVal()->min(10)->validate(11); // true
```

You can also validate:

```php
// Dates
v::dateTime()->max('2010-01-01')->validate('2010-01-01'); // true
v::dateTime()->max('2010-01-01')->validate('2011-01-01'); // false

// DateTimeInterface
v::dateTime()->max(new DateTime('tomorrow'))->validate(new DateTimeImmutable('yesterday')); // true
v::dateTime()->max(new DateTimeImmutable('+1 month'))->validate(new DateTime('today')); // false

// Date intervals
v::dateTime()->max('1988-09-09')->validate('18 years ago'); // true
v::dateTime()->max('+1 minute')->validate('now'); // false

// Single character strings
v::stringType()->lowercase()->max('a')->validate('b'); // true
v::stringType()->uppercase()->max('C')->validate('A'); // false
```

`true` may be passed as a parameter to indicate that inclusive
values must be used.

Message template for this validator includes `{{compareTo}}`.

## Changelog

Version | Description
--------|-------------
  2.0.0 | Became always inclusive
  1.0.0 | Became inclusive by default
  0.3.9 | Created

***
See also:

- [GreaterThan](GreaterThan.md)
- [Length](Length.md)
- [LessThan](LessThan.md)
- [Max](Max.md)
- [MaxAge](MaxAge.md)
- [MinAge](MinAge.md)
