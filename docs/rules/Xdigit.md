# Xdigit

- `Xdigit()`
- `Xdigit(string ...$additionalChars)`

Accepts an hexadecimal number:

```php
v::xdigit()->validate('abc123'); // true
```

Notice, however, that it doesn't accept strings starting with 0x:

```php
v::xdigit()->validate('0x1f'); // false
```

## Changelog

Version | Description
--------|-------------
  0.5.0 | Created

***
See also:

- [Alnum](Alnum.md)
- [Digit](Digit.md)
- [HexRgbColor](HexRgbColor.md)
