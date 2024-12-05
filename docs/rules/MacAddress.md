# MacAddress

- `MacAddress()`

Validates whether the input is a valid MAC address.

```php
v::macAddress()->isValid('00:11:22:33:44:55'); // true
v::macAddress()->isValid('af-AA-22-33-44-55'); // true
```

## Templates

`MacAddress::TEMPLATE_STANDARD`

| Mode       | Template                                 |
|------------|------------------------------------------|
| `default`  | {{name}} must be a valid MAC address     |
| `inverted` | {{name}} must not be a valid MAC address |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
|--------:|-------------|
|   0.3.9 | Created     |

***
See also:

- [Domain](Domain.md)
- [Iban](Iban.md)
- [Ip](Ip.md)
- [PublicDomainSuffix](PublicDomainSuffix.md)
- [Tld](Tld.md)
