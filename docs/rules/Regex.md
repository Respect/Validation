# Regex

- `v::regex(string $regex)`

Evaluates a regex on the input and validates if matches

```php
v::regex('/[a-z]/')->validate('a'); // true
```

Message template for this validator includes `{{regex}}`

***
See also:

  * [Alnum](Alnum.md)
  * [Alpha](Alpha.md)
  * [Contains](Contains.md)
  * [Digit](Digit.md)
  * [EndsWith](EndsWith.md)
  * [PhpLabel](PhpLabel.md)
  * [Roman](Roman.md)
  * [StartsWith](StartsWith.md)
  * [Version](Version.md)
