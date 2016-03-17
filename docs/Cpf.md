# Cpf

- `v::cpf()`

Validates a Brazillian CPF number.

```php
v::cpf()->validate('44455566820'); // true
```

It ignores any non-digit char:

```php
v::cpf()->validate('444.555.668-20'); // true
```

If you need to validate digits only, add `->digit()` to
the chain:

```php
v::digit()->cpf()->validate('44455566820'); // true
```

***
See also:

  * [Cnpj](Cnpj.md)
  * [Cnh](Cnh.md)
