<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Domain

- `Domain()`
- `Domain(bool $tldCheck)`

Validates whether the input is a valid domain name or not.

```php
v::domain()->assert('google.com');
// Validation passes successfully
```

You can skip _top level domain_ (TLD) checks to validate internal
domain names:

```php
v::domain(false)->assert('dev.machine.local');
// Validation passes successfully
```

This is a composite validator, it validates several validators
internally:

- If input is an IP address, it fails.
- If input contains whitespace, it fails.
- If input does not contain any dots, it fails.
- If input has less than two parts, it fails.
- Input must end with a top-level-domain to pass (if not skipped).
- Each part must be alphanumeric and not start with an hyphen.
- [PunnyCode][] is accepted for [Internationalizing Domain Names in Applications][IDNA].

Messages for this validator will reflect validators above.

## Templates

### `Domain::TEMPLATE_STANDARD`

|       Mode | Template                               |
| ---------: | :------------------------------------- |
|  `default` | {{subject}} must be a valid domain     |
| `inverted` | {{subject}} must not be a valid domain |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Internet

## Changelog

| Version | Description             |
| ------: | :---------------------- |
|   0.6.0 | Allow to skip TLD check |
|   0.3.9 | Created                 |

## See Also

- [Ip](Ip.md)
- [Json](Json.md)
- [MacAddress](MacAddress.md)
- [PublicDomainSuffix](PublicDomainSuffix.md)
- [Tld](Tld.md)
- [Url](Url.md)

[PunnyCode]: http://en.wikipedia.org/wiki/Punycode "Wikipedia: Punnycode"
[IDNA]: http://en.wikipedia.org/wiki/Internationalized_domain_name#Internationalizing_Domain_Names_in_Applications "Wikipedia: Internationalized domain name"
