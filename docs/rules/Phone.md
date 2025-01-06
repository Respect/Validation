# Phone

- `Phone()`
- `Phone(string $countyCode)`

Validates whether the input is a valid phone number.

```php
v::phone()->isValid('+1 650 253 00 00'); // true
v::phone('BR')->isValid('+55 11 91111 1111'); // true
v::phone('BR')->isValid('11 91111 1111'); // false
```

## Note

When validating with `$countryCode`, this rule will require the `giggsey/libphonenumber-for-php-lite` package.

## Categorization

- Strings

## Changelog

| Version | Description                         |
|--------:|-------------------------------------|
|   2.3.0 | Introduced a validation per country |
|   0.5.0 | Created                             |

***
See also:

- [Email](Email.md)
- [Json](Json.md)
- [Url](Url.md)
- [VideoUrl](VideoUrl.md)
