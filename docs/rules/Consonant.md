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
  * [Digit](Digit.md)
  * [Alpha](Alpha.md)
  * [Vowel](Vowel.md)
