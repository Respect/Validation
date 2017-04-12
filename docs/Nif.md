# NIF

- `Nif()`

Validates Spain's fiscal identification number ([NIF](https://es.wikipedia.org/wiki/N%C3%BAmero_de_identificaci%C3%B3n_fiscal)).

```php
v::nif()->validate('49294492H'); // true
v::nif()->validate('P6437358A'); // false
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [Bsn](Bsn.md)
- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
