# Alpha

- `Alpha()`
- `Alpha(string $additionalChars)`

Validates whether the input contains only alphabetic characters. This is similar
to [Alnum](Alnum.md), but it does not allow numbers.

```php
v::alpha()->validate('some name'); // false
v::alpha(' ')->validate('some name'); // true
v::alpha()->validate('Cedric-Fabian'); // false
v::alpha('-')->validate('Cedric-Fabian'); // true
```

You can restrict case using the [Lowercase](Lowercase.md) and
[Uppercase](Uppercase.md) rules.

```php
v::alpha()->uppercase()->validate('example'); // false
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Removed support to whitespaces by default
  0.3.9 | Created

***
See also:

- [Alnum](Alnum.md)
- [Digit](Digit.md)
- [Consonant](Consonant.md)
- [Vowel](Vowel.md)
