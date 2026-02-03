<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Ip

- `Ip()`
- `Ip(string $range)`
- `Ip(string $range, int $options)`

Validates whether the input is a valid IP address.

This validator uses the native [filter_var()][] PHP function.

```php
v::ip()->assert('127.0.0.1');
// Validation passes successfully

v::ip('220.78.168.0/21')->assert('220.78.173.2');
// Validation passes successfully

v::ip('220.78.168.0/21')->assert('220.78.176.2');
// → "220.78.176.2" must be an IP address in the 220.78.168.0/255.255.255.255 range
```

Validating ranges:

```php
v::ip('127.0.0.1-127.0.0.5')->assert('127.0.0.2');
// Validation passes successfully

v::ip('127.0.0.1-127.0.0.5')->assert('127.0.0.10');
// → "127.0.0.10" must be an IP address in the 127.0.0.1-127.0.0.5 range
```

You can pass a parameter with [filter_var()][] flags for IP.

```php
v::ip('*', FILTER_FLAG_NO_PRIV_RANGE)->assert('192.168.0.1');
// → "192.168.0.1" must be an IP address
```

If you want to validate IPv6 you can do as follow:

```php
v::ip('*', FILTER_FLAG_IPV6)->assert('2001:0db8:85a3:08d3:1319:8a2e:0370:7334');
// Validation passes successfully
```

## Templates

### `Ip::TEMPLATE_STANDARD`

|       Mode | Template                              |
| ---------: | :------------------------------------ |
|  `default` | {{subject}} must be an IP address     |
| `inverted` | {{subject}} must not be an IP address |

### `Ip::TEMPLATE_NETWORK_RANGE`

|       Mode | Template                                                              |
| ---------: | :-------------------------------------------------------------------- |
|  `default` | {{subject}} must be an IP address in the {{range&#124;raw}} range     |
| `inverted` | {{subject}} must not be an IP address in the {{range&#124;raw}} range |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |
| `range`     |                                                                  |

## Categorization

- Internet

## Changelog

| Version | Description                                            |
| ------: | :----------------------------------------------------- |
|   2.0.0 | Allow to define range and options to the same instance |
|   0.5.0 | Implemented IP range validation                        |
|   0.3.9 | Created                                                |

## See Also

- [Domain](Domain.md)
- [MacAddress](MacAddress.md)
- [PublicDomainSuffix](PublicDomainSuffix.md)
- [Tld](Tld.md)

[filter_var()]: https://php.net/filter_var
