# Control

- `Control()`
- `Control(string ...$additionalChars)`

Validates if all of the characters in the provided string, are control
characters.

```php
v::control()->validate("\n\r\t"); // true
```

## Categorization

- Strings

## Changelog

Version | Description
--------|-------------
  2.0.0 | Renamed from `Cntrl` to `Control`
  0.5.0 | Created

***
See also:

- [Alnum](Alnum.md)
- [Printable](Printable.md)
- [Punct](Punct.md)
- [Space](Space.md)
