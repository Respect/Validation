# MacAddress

- `v::macAddress()`

Validates a Mac Address.

```php
v::macAddress()->validate('00:11:22:33:44:55'); // true
v::macAddress()->validate('af-AA-22-33-44-55'); // true
```

***
See also:

  * [Domain](Domain.md)
  * [Ip](Ip.md)
  * [Tld](Tld.md)
