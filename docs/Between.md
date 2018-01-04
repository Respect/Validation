# Between

- `Between(mixed $start, mixed $end)`
- `Between(mixed $start, mixed $end, bool $inclusive)`

Validates ranges. Most simple example:

```php
v::intVal()->between(10, 20)->isValid(15); // true
```

The type as the first validator in a chain is a good practice,
since between accepts many types:

```php
v::stringType()->between('a', 'f')->isValid('c'); // true
```

Also very powerful with dates:

```php
v::dateTime()->between('2009-01-01', '2013-01-01')->isValid('2010-01-01'); // true
```

Date ranges accept strtotime values:

```php
v::dateTime()->between('yesterday', 'tomorrow')->isValid('now'); // true
```

A third parameter may be passed to validate the passed values inclusive:

```php
v::dateTime()->between(10, 20, true)->isValid(20); // true
```

Message template for this validator includes `{{minValue}}` and `{{maxValue}}`.

## Changelog

Version | Description
--------|-------------
  1.0.0 | Became inclusive by default
  0.3.9 | Created

***
See also:

- [Length](Length.md)
- [Min](Min.md)
- [Max](Max.md)
