# Luhn

- `Luhn()`

Validate whether a given input is a [Luhn][] number.

```php
v::luhn()->validate('2222400041240011'); // true
v::luhn()->validate('respect!'); // false
```

## Categorization

- Identifications

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [CreditCard](CreditCard.md)
- [Imei](Imei.md)
- [Isbn](Isbn.md)

[Luhn]: https://en.wikipedia.org/wiki/Luhn_algorithm
