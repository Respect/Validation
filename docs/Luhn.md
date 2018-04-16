# Luhn

- `Luhn()`

Validate whether a given input is a [Luhn][] number.

```php
v::luhn()->validate('2222400041240011'); // true
v::luhn()->validate('respect!'); // false
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

[Luhn]: https://en.wikipedia.org/wiki/Luhn_algorithm
***
See also:

- [CreditCard](CreditCard.md)
- [Imei](Imei.md)
