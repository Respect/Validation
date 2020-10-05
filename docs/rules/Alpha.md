# Alpha

- `Alpha()`
- `Alpha(string ...$additionalChars)`

Validates whether the input contains only alphabetic characters. This is similar
to [Alnum](Alnum.md), but it does not allow numbers.

```php
v::alpha()->validate('some name'); // false
v::alpha(' ')->validate('some name'); // true
v::alpha()->validate('Cedric-Fabian'); // false
v::alpha('-')->validate('Cedric-Fabian'); // true
v::alpha('-', '\'')->validate('\'s-Gravenhage'); // true
```

You can restrict case using the [Lowercase](Lowercase.md) and
[Uppercase](Uppercase.md) rules.

```php
v::alpha()->uppercase()->validate('example'); // false
```

## Categorization

- Strings

## Changelog

Version | Description
--------|-------------
  2.0.0 | Removed support to whitespaces by default
  0.3.9 | Created

***
See also:

- [Alnum](Alnum.md)
- [Charset](Charset.md)
- [Consonant](Consonant.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [Lowercase](Lowercase.md)
- [NoWhitespace](NoWhitespace.md)
- [NotEmoji](NotEmoji.md)
- [Regex](Regex.md)
- [Uppercase](Uppercase.md)
- [Vowel](Vowel.md)
