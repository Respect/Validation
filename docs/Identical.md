# Identical

- `Identical(mixed $value)`

Validates if the input is identical to some value.

```php
v::identical(42)->validate(42); // true
v::identical(42)->validate('42'); // false
```

Message template for this validator includes `{{compareTo}}`.

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [Contains](Contains.md)
- [Equals](Equals.md)
