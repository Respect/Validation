# Consonant

- `Consonant()`
- `Consonant(string $additionalChars)`

Similar to `Alnum()`. Validates strings that contain only consonants:

```php
v::consonant()->validate('xkcd'); // true
```

## Changelog

Version | Description
--------|-------------
  0.5.0 | Renamed from `Consonants` to `Consonant`
  0.3.9 | Created as `Consonants`

***
See also:

- [Alnum](Alnum.md)
- [Digit](Digit.md)
- [Alpha](Alpha.md)
- [Vowel](Vowel.md)
