# Alnum

- `v::alnum()`
- `v::alnum(string $additionalChars)`

Validates alphanumeric characters.

```php
v::alnum()->validate('foo 123'); // true
v::alnum()->validate('Eso que ni qué'); // true
v::alnum()->validate('Vai filhão'); // true
v::alnum()->validate('Пожалуйста'); // true
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

If you want only the ASCII alphanumeric characters:

```php
v::alnum()->charset('ASCII')->validate('Vai filhão'); // false
v::alnum()->charset('ASCII')->validate('Vai filhao'); // true
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
