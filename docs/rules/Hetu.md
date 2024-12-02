# Hetu

- `Hetu()`

Validates a Finnish personal identity code ([HETU][]).

```php
v::hetu()->isValid('010106A9012'); // true
v::hetu()->isValid('290199-907A'); // true
v::hetu()->isValid('280291+923X'); // true

v::hetu()->isValid('010106_9012'); // false
```

The validation is case-sensitive.

## Categorization

- Identifications

## Changelog

| Version | Description |
|--------:|-------------|
|   3.0.0 | Created     |

***
See also:

- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
- [Imei](Imei.md)
- [Nif](Nif.md)
- [PortugueseNif](PortugueseNif.md)

[HETU]: https://en.wikipedia.org/wiki/National_identification_number#Finland
