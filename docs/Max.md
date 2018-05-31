# Max

- `Max(mixed $compareTo)`

Validates whether the input is less than or equal to a value.

```php
v::max(10)->validate(9); // true
v::max(10)->validate(10); // true
v::max(10)->validate(11); // false
```

You can also validate:

```php
// Dates
v::dateTime()->max('2010-01-01')->validate('2000-01-01'); // true
v::dateTime()->max('2010-01-01')->validate('2020-01-01'); // false

// DateTimeInterface
v::dateTime()->max(new DateTime('today'))->validate(new DateTimeImmutable('yesterday')); // true
v::dateTime()->max(new DateTimeImmutable('today'))->validate(new DateTime('tomorrow')); // false

// Date intervals
v::dateTime()->max('18 years ago')->validate('1988-09-09'); // true
v::dateTime()->max('now')->validate('+1 minute'); // false

// Single character strings
v::stringType()->lowercase()->max('z')->validate('a'); // true
v::stringType()->uppercase()->max('B')->validate('C'); // false
```

Message template for this validator includes `{{compareTo}}`.

## Changelog

Version | Description
--------|-------------
  2.0.0 | Became always inclusive
  1.0.0 | Became inclusive by default
  0.3.9 | Created

***
See also:

- [Between](Between.md)
- [GreaterThan](GreaterThan.md)
- [LessThan](LessThan.md)
- [Min](Min.md)
