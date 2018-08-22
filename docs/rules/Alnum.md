# Alnum

- `v::alnum()`
- `v::alnum(string $additionalChars)`

Validates alphanumeric characters from a-Z and 0-9.

```php
v::alnum()->validate('foo 123'); // true
v::alnum()->validate('number 100%'); // false
v::alnum('%')->validate('number 100%'); // true
```

Because this rule allows whitespaces by default, you can separate additional
characters with a whitespace:

```php
v::alnum('- ! :')->validate('foo :- 123 !'); // true
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

***
See also:

  * [Alpha](Alpha.md)
  * [Digit](Digit.md)
  * [Consonant](Consonant.md)
  * [Vowel](Vowel.md)
