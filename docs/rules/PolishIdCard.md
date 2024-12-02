# PolishIdCard

- `PolishIdCard()`

Validates whether the input is a Polish identity card (Dowód Osobisty).

```php
v::polishIdCard()->isValid('AYW036733'); // true
v::polishIdCard()->isValid('APH505567'); // true
v::polishIdCard()->isValid('APH 505567'); // false
v::polishIdCard()->isValid('AYW036731'); // false
```

## Categorization

- Identifications

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [Nip](Nip.md)
- [Pesel](Pesel.md)
- [SubdivisionCode](SubdivisionCode.md)
