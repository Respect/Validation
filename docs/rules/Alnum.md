# Alnum

- `Alnum()`
- `Alnum(string ...$additionalChars)`

Validates whether the input is alphanumeric or not.

Alphanumeric is a combination of alphabetic (a-z and A-Z) and numeric (0-9)
characters.

```php
v::alnum()->validate('foo 123'); // false
v::alnum(' ')->validate('foo 123'); // true
v::alnum()->validate('100%'); // false
v::alnum('%')->validate('100%'); // true
v::alnum('%', ',')->validate('10,5%'); // true
```

You can restrict case using the [Lowercase](Lowercase.md) and
[Uppercase](Uppercase.md) rules.

```php
v::alnum()->uppercase()->validate('example'); // false
```

Message template for this validator includes `{{additionalChars}}` as the string
of extra chars passed as the parameter.

## Categorization

- Strings

## Changelog

Version | Description
--------|-------------
  2.0.0 | Removed support to whitespaces by default
  0.3.9 | Created

***
See also:

- [Alpha](Alpha.md)
- [Charset](Charset.md)
- [Consonant](Consonant.md)
- [Control](Control.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [Lowercase](Lowercase.md)
- [NoWhitespace](NoWhitespace.md)
- [NotEmoji](NotEmoji.md)
- [Regex](Regex.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
- [Uppercase](Uppercase.md)
- [Vowel](Vowel.md)
- [Xdigit](Xdigit.md)
