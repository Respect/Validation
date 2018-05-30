# Uppercase

- `Uppercase()`

Validates whether the characters in the input are uppercase.

```php
v::uppercase()->validate('W3C'); // true
```

This rule does not validate if the input a numeric value, so `123` and `%` will
be valid. Please add more validations to the chain if you want to refine your
validation.

```php
v::not(v::numericVal())->uppercase()->validate('42'); // false
v::alnum()->uppercase()->validate('#$%!'); // false
v::not(v::numericVal())->alnum()->uppercase()->validate('W3C'); // true
```

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Alnum](Alnum.md)
- [Lowercase](Lowercase.md)
- [NumericVal](NumericVal.md)
