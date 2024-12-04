# PortugueseNif

- `PortugueseNif()`

Validates Portugal's fiscal identification number ([NIF](https://pt.wikipedia.org/wiki/N%C3%BAmero_de_identifica%C3%A7%C3%A3o_fiscal)).

```php
v::portugueseNif()->isValid('124885446'); // true
v::portugueseNif()->isValid('220005245'); // false
```

## Templates

`PortugueseNif::TEMPLATE_STANDARD`

| Mode       | Template                              |
|------------|---------------------------------------|
| `default`  | {{name}} must be a Portuguese NIF     |
| `inverted` | {{name}} must not be a Portuguese NIF |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
|--------:|-------------|
|   2.2.0 | Created     |

***
See also:

- [Bsn](Bsn.md)
- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
- [Hetu](Hetu.md)
- [Nif](Nif.md)
