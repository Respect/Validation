# Tld

- `Tld()`

Validates whether the input is a top-level domain.

```php
v::tld()->isValid('com'); // true
v::tld()->isValid('ly'); // true
v::tld()->isValid('org'); // true
v::tld()->isValid('COM'); // true
```

## Templates

### `Tld::TEMPLATE_STANDARD`

| Mode       | Template                                           |
|------------|----------------------------------------------------|
| `default`  | {{name}} must be a valid top-level domain name     |
| `inverted` | {{name}} must not be a valid top-level domain name |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Internet

## Changelog

| Version | Description |
|--------:|-------------|
|   0.3.9 | Created     |

***
See also:

- [CountryCode](CountryCode.md)
- [Domain](Domain.md)
- [Ip](Ip.md)
- [MacAddress](MacAddress.md)
- [PublicDomainSuffix](PublicDomainSuffix.md)
- [SubdivisionCode](SubdivisionCode.md)
