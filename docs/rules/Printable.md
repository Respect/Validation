# Printable

- `Printable()`
- `Printable(string ...$additionalChars)`

Similar to `Graph` but accepts whitespace.

```php
use Respect\Validation\Validator as v;

v::printable()->validate('LMKA0$% _123'); // true
```

## Categorization

- Strings

## Changelog

Version | Description
--------|-------------
  0.5.0 | Created

***
See also:

- [Control](Control.md)
- [Graph](Graph.md)
- [Punct](Punct.md)
