# NfeAccessKey

- `NfeAccessKey(string $accessKey)`

Validates the access key of the Brazilian electronic invoice (NFe).

```php
v::nfeAccessKey()->validate('31841136830118868211870485416765268625116906'); // true
```

## Changelog

Version | Description
--------|-------------
  0.6.0 | Created

***
See also:

- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
