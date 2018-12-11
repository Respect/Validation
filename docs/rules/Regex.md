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
- [CreditCard](CreditCard.md)
- [Digit](Digit.md)
- [EndsWith](EndsWith.md)
- [PhpLabel](PhpLabel.md)
- [Roman](Roman.md)
- [StartsWith](StartsWith.md)
- [Version](Version.md)
