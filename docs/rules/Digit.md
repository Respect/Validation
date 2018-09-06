# Digit

- `Digit()`
- `Digit(string $additionalChars)`

Validates whether the input contains only digits.

```php
v::digit()->validate('020 612 1851'); // false
v::digit(' ')->validate('020 612 1851'); // true
v::digit()->validate('172.655.537-21'); // false
v::digit('.-')->validate('172.655.537-21'); // true
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Removed support to whitespaces by default
  0.5.0 | Renamed from `Digits` to `Digit`
  0.3.9 | Created as `Digits`

***
See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Vowel](Vowel.md)
- [Consonant](Consonant.md)
