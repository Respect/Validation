# Alpha

- `Alpha()`
- `Alpha(string ...$additionalChars)`

Validates whether the input contains only alphabetic characters. This is similar
to [Alnum](Alnum.md), but it does not allow numbers.

```php
v::alpha()->isValid('some name'); // false
v::alpha(' ')->isValid('some name'); // true
v::alpha()->isValid('Cedric-Fabian'); // false
v::alpha('-')->isValid('Cedric-Fabian'); // true
v::alpha('-', '\'')->isValid('\'s-Gravenhage'); // true
```

You can restrict case using the [Lowercase](Lowercase.md) and
[Uppercase](Uppercase.md) rules.

```php
v::alpha()->uppercase()->isValid('example'); // false
```

## Templates

`Alpha::TEMPLATE_STANDARD`

| Mode       | Template                                 |
|------------|------------------------------------------|
| `default`  | {{name}} must contain only letters (a-z) |
| `inverted` | {{name}} must not contain letters (a-z)  |

`Alpha::TEMPLATE_EXTRA`

| Mode       | Template                                                         |
|------------|------------------------------------------------------------------|
| `default`  | {{name}} must contain only letters (a-z) and {{additionalChars}} |
| `inverted` | {{name}} must not contain letters (a-z) or {{additionalChars}}   |

## Template placeholders

| Placeholder       | Description                                                      |
|-------------------|------------------------------------------------------------------|
| `additionalChars` | Additional characters that are considered valid.                 |
| `name`            | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                               |
|--------:|-------------------------------------------|
|   2.0.0 | Removed support to whitespaces by default |
|   0.3.9 | Created                                   |

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
