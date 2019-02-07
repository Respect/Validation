# Cntrl

- `Cntrl()`
- `Cntrl(string ...$additionalChars)`

Validates if all of the characters in the provided string, are control
characters.

```php
v::cntrl()->validate("\n\r\t"); // true
```

## Changelog

Version | Description
--------|-------------
  0.5.0 | Created

***
See also:

- [Alnum](Alnum.md)
- [Printable](Printable.md)
- [Punct](Punct.md)
- [Space](Space.md)
