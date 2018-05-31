# Printable

- `Printable()`
- `Printable(string $additionalChars)`

Similar to `Graph` but accepts whitespace.

```php
v::printable()->validate('LMKA0$% _123'); // true
```

## Changelog

Version | Description
--------|-------------
  0.5.0 | Created

***
See also:

- [Graph](Graph.md)
