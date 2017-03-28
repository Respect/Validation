# Pis

- `Pis()`

Validates a Brazilian PIS/NIS number ignoring any non-digit char.

```php
v::pis()->validate('120.0340.678-8'); // true
v::pis()->validate('120.03406788'); // true
v::pis()->validate('120.0340.6788'); // true
v::pis()->validate('1.2.0.0.3.4.0.6.7.8.8'); // true
v::pis()->validate('12003406788'); // true
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [Cpf](Cpf.md)
- [Cnpj](Cnpj.md)
- [Cnh](Cnh.md)
