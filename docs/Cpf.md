# Cpf

- `Cpf()`

Validates a Brazillian CPF number.

```php
v::cpf()->isValid('44455566820'); // true
```

It ignores any non-digit char:

```php
v::cpf()->isValid('444.555.668-20'); // true
```

If you need to validate digits only, add `->digit()` to
the chain:

```php
v::digit()->cpf()->isValid('44455566820'); // true
```

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Cnpj](Cnpj.md)
- [Cnh](Cnh.md)
