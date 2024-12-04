# Pesel

- `Pesel()`

Validates PESEL (Polish human identification number).

```php
v::pesel()->isValid('21120209256'); // true
v::pesel()->isValid('97072704800'); // true
v::pesel()->isValid('97072704801'); // false
v::pesel()->isValid('PESEL123456'); // false
```

## Templates

`Pesel::TEMPLATE_STANDARD`

| Mode       | Template                           |
|------------|------------------------------------|
| `default`  | {{name}} must be a valid PESEL     |
| `inverted` | {{name}} must not be a valid PESEL |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
|--------:|-------------|
|   1.1.0 | Created     |

***
See also:

- [Nip](Nip.md)
- [PolishIdCard](PolishIdCard.md)
- [SubdivisionCode](SubdivisionCode.md)
