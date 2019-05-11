# NoWhitespace

- `NoWhitespace()`

Validates if a string contains no whitespace (spaces, tabs and line breaks);

```php
v::noWhitespace()->validate('foo bar');  //false
v::noWhitespace()->validate("foo\nbar"); // false
```

This is most useful when chaining with other validators such as `Alnum()`

## Categorization

- Strings

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [CreditCard](CreditCard.md)
- [NotBlank](NotBlank.md)
- [NotEmpty](NotEmpty.md)
- [NotOptional](NotOptional.md)
- [Optional](Optional.md)
