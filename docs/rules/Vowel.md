# Vowel

- `Vowel()`
- `Vowel(string ...$additionalChars)`

Validates whether the input contains only vowels.

```php
v::vowel()->validate('aei'); // true
```

## Categorization

- Strings

## Changelog

Version | Description
--------|-------------
  2.0.0 | Do not consider whitespaces as valid
  0.5.0 | Renamed from `Vowels` to `Vowel`
  0.3.9 | Created as `Vowels`

***
See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Consonant](Consonant.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
