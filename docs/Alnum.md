# Alnum

- `Alnum()`
- `Alnum(string $additionalChars)`

Validates alphanumeric characters from a-Z and 0-9.

```php
v::alnum()->validate('foo 123'); // true
```

A parameter for extra characters can be used:

```php
v::alnum('-')->validate('foo - 123'); // true
```

This validator allows whitespace, if you want to
remove them add `->noWhitespace()` to the chain:

```php
v::alnum()->noWhitespace()->validate('foo 123'); // false
```

You can restrict case using the `->lowercase()` and
`->uppercase()` validators:

```php
v::alnum()->uppercase()->validate('aaa'); // false
```

Message template for this validator includes `{{additionalChars}}` as
the string of extra chars passed as the parameter.

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Alpha](Alpha.md)
- [Digit](Digit.md)
- [Consonant](Consonant.md)
- [Vowel](Vowel.md)
