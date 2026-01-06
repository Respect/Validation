# NfeAccessKey

- `NfeAccessKey(string $accessKey)`

Validates the access key of the Brazilian electronic invoice (NFe).

```php
v::nfeAccessKey()->assert('31841136830118868211870485416765268625116906');
// → "31841136830118868211870485416765268625116906" must be a valid NFe access key
```

## Templates

### `NfeAccessKey::TEMPLATE_STANDARD`

| Mode       | Template                                       |
| ---------- | ---------------------------------------------- |
| `default`  | {{subject}} must be a valid NFe access key     |
| `inverted` | {{subject}} must not be a valid NFe access key |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.6.0 | Created     |

---

See also:

- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
