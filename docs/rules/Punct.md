# Punct

- `Punct()`
- `Punct(string ...$additionalChars)`

Validates whether the input composed by only punctuation characters.

```php
use Respect\Validation\Validator as v;

v::punct()->validate('&,.;[]'); // true
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
- [Printable](Printable.md)
