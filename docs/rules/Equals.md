# Equals

- `Equals(mixed $compareTo)`

Validates if the input is equal to some value.

```php
v::equals('alganet')->isValid('alganet'); // true
```

Message template for this validator includes `{{compareTo}}`.

## Categorization

- Comparisons

## Changelog

Version | Description
--------|-------------
  1.0.0 | Removed identical checking (see [Identical](Identical.md))
  0.3.9 | Created

***
See also:

- [Contains](Contains.md)
- [Equivalent](Equivalent.md)
- [Identical](Identical.md)
- [KeyValue](KeyValue.md)
- [Version](Version.md)
