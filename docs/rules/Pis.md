# Pis

- `Pis()`

Validates a Brazilian PIS/NIS number ignoring any non-digit char.

```php
v::pis()->isValid('120.0340.678-8'); // true
v::pis()->isValid('120.03406788'); // true
v::pis()->isValid('120.0340.6788'); // true
v::pis()->isValid('1.2.0.0.3.4.0.6.7.8.8'); // true
v::pis()->isValid('12003406788'); // true
```

## Templates

`Pis::TEMPLATE_STANDARD`

| Mode       | Template                                |
|------------|-----------------------------------------|
| `default`  | {{name}} must be a valid PIS number     |
| `inverted` | {{name}} must not be a valid PIS number |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
|--------:|-------------|
|   2.0.0 | Created     |

***
See also:

- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
