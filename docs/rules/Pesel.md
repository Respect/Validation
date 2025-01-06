# Pesel

- `Pesel()`

Validates PESEL (Polish human identification number).

```php
v::pesel()->isValid('21120209256'); // true
v::pesel()->isValid('97072704800'); // true
v::pesel()->isValid('97072704801'); // false
v::pesel()->isValid('PESEL123456'); // false
```

## Categorization

- Identifications

## Changelog

Version | Description
--------|-------------
  1.1.0 | Created

***
See also:

- [Nip](Nip.md)
- [PolishIdCard](PolishIdCard.md)
- [SubdivisionCode](SubdivisionCode.md)
