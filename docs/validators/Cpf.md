# Cpf

- `Cpf()`

Validates a Brazillian CPF number.

```php
v::cpf()->assert('11598647644');
// Validation passes successfully
```

It ignores any non-digit char:

```php
v::cpf()->assert('693.319.118-40');
// Validation passes successfully
```

If you need to validate digits only, add `->digit()` to
the chain:

```php
v::digit()->cpf()->assert('11598647644');
// Validation passes successfully
```

## Templates

### `Cpf::TEMPLATE_STANDARD`

| Mode       | Template                                   |
| ---------- | ------------------------------------------ |
| `default`  | {{subject}} must be a valid CPF number     |
| `inverted` | {{subject}} must not be a valid CPF number |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.3.9 | Created     |

---

See also:

- [Bsn](Bsn.md)
- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Hetu](Hetu.md)
- [Imei](Imei.md)
- [NfeAccessKey](NfeAccessKey.md)
- [Nif](Nif.md)
- [Pis](Pis.md)
- [PortugueseNif](PortugueseNif.md)
