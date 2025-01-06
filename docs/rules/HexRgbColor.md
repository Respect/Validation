# HexRgbColor

- `HexRgbColor()`

Validates whether the input is a hex RGB color or not.

```php
v::hexRgbColor()->isValid('#FFFAAA'); // true
v::hexRgbColor()->isValid('#ff6600'); // true
v::hexRgbColor()->isValid('123123'); // true
v::hexRgbColor()->isValid('FCD'); // true
```

## Categorization

- Strings

## Changelog

Version | Description
--------|-------------
  2.1.0 | Allow hex RGB colors to be case-insensitive
  2.0.0 | Allow hex RGB colors with 3 integers
  0.7.0 | Created

***
See also:

- [Xdigit](Xdigit.md)
