# Ip

- `Ip()`
- `Ip(mixed $options)`

Validates IP Addresses. This validator uses the native filter_var()
PHP function.

```php
v::ip()->validate('192.168.0.1');
```

You can pass a parameter with filter_var flags for IP.

```php
v::ip(FILTER_FLAG_NO_PRIV_RANGE)->validate('127.0.0.1'); // false
```

## Changelog

Version | Description
--------|-------------
  0.5.0 | Implemented IP range validatio
  0.3.9 | Created

***
See also:

- [Domain](Domain.md)
- [MacAddress](MacAddress.md)
- [Tld](Tld.md)
