# Cpf

- `Cpf()`

Validates a Brazillian CPF number.

```php
v::cpf()->isValid('11598647644'); // true
```

It ignores any non-digit char:

```php
v::cpf()->isValid('693.319.118-40'); // true
```

If you need to validate digits only, add `->digit()` to
the chain:

```php
v::digit()->cpf()->isValid('11598647644'); // true
```

## Categorization

- Identifications

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Bsn](Bsn.md)
- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Imei](Imei.md)
- [NfeAccessKey](NfeAccessKey.md)
- [Nif](Nif.md)
- [Pis](Pis.md)
- [PortugueseNif](PortugueseNif.md)
