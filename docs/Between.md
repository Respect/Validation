# Between

- `Between(mixed $minimum, mixed $maximum)`

Validates whether the input is between two other values.

```php
v::intVal()->between(10, 20)->validate(10); // true
v::intVal()->between(10, 20)->validate(15); // true
v::intVal()->between(10, 20)->validate(20); // true
```

The type as the first validator in a chain is a good practice,
since between accepts many types:

```php
v::stringType()->between('a', 'f')->validate('c'); // true
```

Also very powerful with dates:

```php
v::dateTime()->between('2009-01-01', '2013-01-01')->validate('2010-01-01'); // true
```

Date ranges accept date intervals:

```php
v::dateTime()->between('yesterday', 'tomorrow')->validate('now'); // true
```

Message template for this validator includes `{{minValue}}` and `{{maxValue}}`.

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
- [Min](Min.md)
