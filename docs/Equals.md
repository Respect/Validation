# Equals

- `Equals(mixed $compareTo)`

Validates if the input is equal to some value.

```php
v::equals('alganet')->validate('alganet'); // true
```

Message template for this validator includes `{{compareTo}}`.

## Changelog

Version | Description
--------|-------------
  1.0.0 | Removed identical checking (see [Identical](Identical.md))
  0.3.9 | Created

***
See also:

- [Contains](Contains.md)
- [Identical](Identical.md)
