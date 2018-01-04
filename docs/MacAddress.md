# MacAddress

- `MacAddress()`

Validates a Mac Address.

```php
v::macAddress()->isValid('00:11:22:33:44:55'); // true
v::macAddress()->isValid('af-AA-22-33-44-55'); // true
```

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Domain](Domain.md)
- [Ip](Ip.md)
- [Tld](Tld.md)
