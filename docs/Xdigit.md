# Xdigit

- `Xdigit()`

Accepts an hexadecimal number:

```php
v::xdigit()->isValid('abc123'); // true
```

Notice, however, that it doesn't accept strings starting with 0x:

```php
v::xdigit()->isValid('0x1f'); // false
```

## Changelog

Version | Description
--------|-------------
  0.5.0 | Created

***
See also:

- [Digit](Digit.md)
- [Alnum](Alnum.md)
- [HexRgbColor](HexRgbColor.md)
