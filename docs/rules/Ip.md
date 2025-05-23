# Ip

- `Ip()`
- `Ip(string $range)`
- `Ip(string $range, int $options)`

Validates whether the input is a valid IP address.

This validator uses the native [filter_var()][] PHP function.

```php
v::ip()->isValid('127.0.0.1'); // true
v::ip('220.78.168.0/21')->isValid('220.78.173.2'); // true
v::ip('220.78.168.0/21')->isValid('220.78.176.2'); // false
```

Validating ranges:

```php
v::ip('127.0.0.1-127.0.0.5')->isValid('127.0.0.2'); // true
v::ip('127.0.0.1-127.0.0.5')->isValid('127.0.0.10'); // false
```

You can pass a parameter with [filter_var()][] flags for IP.

```php
v::ip('*', FILTER_FLAG_NO_PRIV_RANGE)->isValid('192.168.0.1'); // false
```

If you want to validate IPv6 you can do as follow:

```php
v::ip('*', FILTER_FLAG_IPV6)->isValid('2001:0db8:85a3:08d3:1319:8a2e:0370:7334'); // true
```

## Categorization

- Internet

## Changelog

Version | Description
--------|-------------
  2.0.0 | Allow to define range and options to the same instance
  0.5.0 | Implemented IP range validation
  0.3.9 | Created

***
See also:

- [Domain](Domain.md)
- [MacAddress](MacAddress.md)
- [PublicDomainSuffix](PublicDomainSuffix.md)
- [Tld](Tld.md)

[filter_var()]: https://php.net/filter_var
