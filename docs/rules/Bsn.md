# Bsn

- `Bsn()`

Validates a Dutch citizen service number ([BSN](https://nl.wikipedia.org/wiki/Burgerservicenummer)).

```php
v::bsn()->isValid('612890053'); // true
```

## Templates

`Bsn::TEMPLATE_STANDARD`

| Mode       | Template                         |
|------------|----------------------------------|
| `default`  | {{name}} must be a valid BSN     |
| `inverted` | {{name}} must not be a valid BSN |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
|--------:|-------------|
|   1.0.0 | Created     |

***
See also:

- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
- [Imei](Imei.md)
- [Nif](Nif.md)
- [PortugueseNif](PortugueseNif.md)
