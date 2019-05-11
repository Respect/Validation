# MacAddress

- `MacAddress()`

Validates whether the input is a valid MAC address.

```php
v::macAddress()->validate('00:11:22:33:44:55'); // true
v::macAddress()->validate('af-AA-22-33-44-55'); // true
```

## Categorization

- Identifications

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Domain](Domain.md)
- [Iban](Iban.md)
- [Ip](Ip.md)
- [Tld](Tld.md)
