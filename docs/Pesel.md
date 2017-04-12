# Pesel

- `Pesel()`

Validates PESEL (Polish human identification number).

```php
v::pesel()->validate('21120209256'); // true
v::pesel()->validate('97072704800'); // true
v::pesel()->validate('97072704801'); // false
v::pesel()->validate('PESEL123456'); // false
```

## Changelog

Version | Description
--------|-------------
  1.1.0 | Created

***
See also:

- [Bank](Bank.md)
- [IdentityCard](IdentityCard.md)
- [SubdivisionCode](SubdivisionCode.md)
- [Vatin](Vatin.md)
