# Phone

- `Phone()`

Validates whether the input is a valid phone number. This rule requires
the `giggsey/libphonenumber-for-php-lite` package.


```php
v::phone()->isValid('+1 650 253 00 00'); // true
v::phone('BR')->isValid('+55 11 91111 1111'); // true
v::phone('BR')->isValid('11 91111 1111'); // false
```

## Categorization

- Strings

## Changelog

Version | Description
--------|-------------
  2.3.0 | Updated to use external validator
  0.5.0 | Created

***
See also:

- [Email](Email.md)
- [Json](Json.md)
- [Url](Url.md)
- [VideoUrl](VideoUrl.md)
