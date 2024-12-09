# Cnh

- `Cnh()`

Validates a Brazilian driver's license.

```php
v::cnh()->isValid('02650306461'); // true
```

## Templates

### `Cnh::TEMPLATE_STANDARD`

| Mode       | Template                                |
|------------|-----------------------------------------|
| `default`  | {{name}} must be a valid CNH number     |
| `inverted` | {{name}} must not be a valid CNH number |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
|--------:|-------------|
|   0.5.0 | Created     |

***
See also:

- [Bsn](Bsn.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
- [Hetu](Hetu.md)
- [Imei](Imei.md)
- [NfeAccessKey](NfeAccessKey.md)
- [Nif](Nif.md)
- [Pis](Pis.md)
- [PortugueseNif](PortugueseNif.md)
