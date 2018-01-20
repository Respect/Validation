# Regex

- `Regex(string $regex)`

Evaluates a regex on the input and validates if matches

```php
v::regex('/[a-z]/')->validate('a'); // true
```

Message template for this validator includes `{{regex}}`

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Contains](Contains.md)
- [Digit](Digit.md)
- [EndsWith](EndsWith.md)
- [StartsWith](StartsWith.md)
