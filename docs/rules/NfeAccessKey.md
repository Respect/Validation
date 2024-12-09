# NfeAccessKey

- `NfeAccessKey(string $accessKey)`

Validates the access key of the Brazilian electronic invoice (NFe).

```php
v::nfeAccessKey()->isValid('31841136830118868211870485416765268625116906'); // true
```

## Templates

### `NfeAccessKey::TEMPLATE_STANDARD`

| Mode       | Template                                    |
|------------|---------------------------------------------|
| `default`  | {{name}} must be a valid NFe access key     |
| `inverted` | {{name}} must not be a valid NFe access key |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
|--------:|-------------|
|   0.6.0 | Created     |

***
See also:

- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
