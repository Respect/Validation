# GreaterThan

- `GreaterThan(mixed $compareTo)`

Validates whether the input is greater than a value.

```php
v::greaterThan(10)->validate(11); // true
v::greaterThan(10)->validate(9); // false
```

You can also validate:

```php
// Dates
v::dateTime()->greaterThan('2010-01-01')->validate('2020-01-01'); // true
v::dateTime()->greaterThan('2010-01-01')->validate('2000-01-01'); // false

// Date intervals
v::dateTime()->greaterThan('yesterday')->validate('now'); // true
v::dateTime()->greaterThan('18 years ago')->validate('5 days later'); // false

// Single character strings
v::dateTime()->greaterThan('A')->validate('B'); // true
v::dateTime()->greaterThan('c')->validate('a'); // false
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
