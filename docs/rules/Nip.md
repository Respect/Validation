# Nip

- `Nip(string $countryCode)`

Validates whether the input is a Polish VAT identification number (NIP).

```php
v::nip()->validate('1645865777'); // true
v::nip()->validate('1645865778'); // false
v::nip()->validate('1234567890'); // false
v::nip()->validate('164-586-57-77'); // false
v::nip()->validate('164-58-65-777'); // false
```

## Categorization

- Identifications

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [Pesel](Pesel.md)
- [PolishIdCard](PolishIdCard.md)
- [SubdivisionCode](SubdivisionCode.md)
