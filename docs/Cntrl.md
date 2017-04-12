# Cntrl

- `Cntrl()`
- `Cntrl(string $additionalChars)`

This is similar to `Alnum()`, but only accepts control characters:

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
- [Prnt](Prnt.md)
- [Space](Space.md)
