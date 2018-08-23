# Factor

- `Factor(int $dividend)`

Validates if the input is a factor of the defined dividend.

```php
v::factor(0)->validate(5); // true
v::factor(4)->validate(2); // true
v::factor(4)->validate(3); // false
```

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [Digit](Digit.md)
- [Finite](Finite.md)
- [Infinite](Infinite.md)
- [NumericVal](NumericVal.md)
