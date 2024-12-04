# Consonant

- `Consonant()`
- `Consonant(string ...$additionalChars)`

Validates if the input contains only consonants.

```php
v::consonant()->isValid('xkcd'); // true
```

## Templates

`Consonant::TEMPLATE_STANDARD`

| Mode       | Template                              |
|------------|---------------------------------------|
| `default`  | {{name}} must only contain consonants |
| `inverted` | {{name}} must not contain consonants  |

`Consonant::TEMPLATE_EXTRA`

| Mode       | Template                                                      |
|------------|---------------------------------------------------------------|
| `default`  | {{name}} must only contain consonants and {{additionalChars}} |
| `inverted` | {{name}} must not contain consonants or {{additionalChars}}   |

## Template placeholders

| Placeholder       | Description                                                      |
|-------------------|------------------------------------------------------------------|
| `additionalChars` | Additional characters that are considered valid.                 |
| `name`            | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                              |
|--------:|------------------------------------------|
|   0.5.0 | Renamed from `Consonants` to `Consonant` |
|   0.3.9 | Created as `Consonants`                  |

***
See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [Vowel](Vowel.md)
