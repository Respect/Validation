# Cpf

- `Cpf()`

Validates a Brazillian CPF number.

```php
v::cpf()->validate('11598647644'); // true
```

It ignores any non-digit char:

```php
v::cpf()->validate('693.319.118-40'); // true
```

If you need to validate digits only, add `->digit()` to
the chain:

```php
v::digit()->cpf()->validate('11598647644'); // true
```

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Cnpj](Cnpj.md)
- [Cnh](Cnh.md)
