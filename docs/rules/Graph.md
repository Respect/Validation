# Graph

- `Graph()`
- `Graph(string ...$additionalChars)`

Validates if all characters in the input are printable and actually creates
visible output (no white space).

```php
v::graph()->isValid('LKM@#$%4;'); // true
```

## Categorization

- Strings

## Changelog

Version | Description
--------|-------------
  0.5.0 | Created

***
See also:

- [Printable](Printable.md)
- [Punct](Punct.md)
