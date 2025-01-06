# Xdigit

- `Xdigit()`
- `Xdigit(string ...$additionalChars)`

Validates whether the input is an hexadecimal number or not.

```php
v::xdigit()->isValid('abc123'); // true
```

Notice, however, that it doesn't accept strings starting with 0x:

```php
v::xdigit()->isValid('0x1f'); // false
```

## Categorization

- Strings

## Changelog

Version | Description
--------|-------------
  0.5.0 | Created

***
See also:

- [Alnum](Alnum.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [HexRgbColor](HexRgbColor.md)
