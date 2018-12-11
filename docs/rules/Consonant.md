# Consonant

- `v::consonant()`
- `v::consonant(string $additionalChars)`

Similar to `v::alnum()`. Validates strings that contain only consonants:

```php
v::consonant()->validate('xkcd'); // true
```

***
See also:

  * [Alnum](Alnum.md)
  * [Alpha](Alpha.md)
  * [Digit](Digit.md)
  * [Vowel](Vowel.md)
