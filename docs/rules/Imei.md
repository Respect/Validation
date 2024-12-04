# Imei

- `Imei()`

Validates is the input is a valid [IMEI][].

```php
v::imei()->isValid('35-209900-176148-1'); // true
v::imei()->isValid('490154203237518'); // true
```

## Templates

`Imei::TEMPLATE_STANDARD`

| Mode       | Template                                 |
|------------|------------------------------------------|
| `default`  | {{name}} must be a valid IMEI number     |
| `inverted` | {{name}} must not be a valid IMEI number |

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

- [Bsn](Bsn.md)
- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
- [Hetu](Hetu.md)
- [Isbn](Isbn.md)
- [Luhn](Luhn.md)

[IMEI]: https://en.wikipedia.org/wiki/International_Mobile_Station_Equipment_Identity "International Mobile Station Equipment Identity"
