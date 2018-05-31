# LessThan

- `LessThan(mixed $compareTo)`

Validates whether the input is less than a value.

```php
v::lessThan(10)->validate(9); // true
v::lessThan(10)->validate(10); // false
```

You can also validate:

```php
// Dates
v::dateTime()->lessThan('2010-01-01')->validate('2000-01-01'); // true
v::dateTime()->lessThan('2010-01-01')->validate('2020-01-01'); // false

// Date intervals
v::dateTime()->lessThan('today')->validate('3 days ago'); // true
v::dateTime()->lessThan('yesterday')->validate('tomorrow'); // false

// Single character strings
v::dateTime()->lessThan('b')->validate('a'); // true
v::dateTime()->lessThan('a')->validate('z'); // false
```

Message template for this validator includes `{{compareTo}}`.

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [Between](Between.md)
- [Max](Max.md)
- [Min](Min.md)
