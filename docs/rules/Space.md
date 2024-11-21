# Space

- `Space()`
- `Space(string ...$additionalChars)`

Validates whether the input contains only whitespaces characters.

```php
use Respect\Validation\Validator as v;

v::space()->validate('    '); // true
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
