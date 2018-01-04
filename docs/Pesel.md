# Pesel

- `Pesel()`

Validates PESEL (Polish human identification number).

```php
v::pesel()->isValid('21120209256'); // true
v::pesel()->isValid('97072704800'); // true
v::pesel()->isValid('97072704801'); // false
v::pesel()->isValid('PESEL123456'); // false
```

## Changelog

Version | Description
--------|-------------
  1.1.0 | Created

***
See also:

- [IdentityCard](IdentityCard.md)
- [SubdivisionCode](SubdivisionCode.md)
- [Vatin](Vatin.md)
