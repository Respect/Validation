# NIF

- `Nif()`

Validates Spain's fiscal identification number ([NIF](https://es.wikipedia.org/wiki/N%C3%BAmero_de_identificaci%C3%B3n_fiscal)).

```php
v::nif()->isValid('49294492H'); // true
v::nif()->isValid('P6437358A'); // false
```

## Templates

`Nif::TEMPLATE_STANDARD`

| Mode       | Template                         |
|------------|----------------------------------|
| `default`  | {{name}} must be a valid NIF     |
| `inverted` | {{name}} must not be a valid NIF |

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
- [PortugueseNif](PortugueseNif.md)
