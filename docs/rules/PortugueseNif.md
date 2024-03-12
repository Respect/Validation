# PortugueseNif

- `PortugueseNif()`

Validates Portugal's fiscal identification number ([NIF](https://pt.wikipedia.org/wiki/N%C3%BAmero_de_identifica%C3%A7%C3%A3o_fiscal)).

```php
v::portugueseNif()->validate('124885446'); // true
v::portugueseNif()->validate('220005245'); // false
```

## Categorization

- Identifications

## Changelog

| Version | Description |
| ------: | ----------- |
|   2.2.0 | Created     |

***
See also:

- [Bsn](Bsn.md)
- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
- [Hetu](Hetu.md)
- [Nif](Nif.md)
