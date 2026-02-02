<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Consonant

- `Consonant()`
- `Consonant(string ...$additionalChars)`

Validates if the input contains only consonants.

```php
v::consonant()->assert('xkcd');
// Validation passes successfully
```

## Templates

### `Consonant::TEMPLATE_STANDARD`

|       Mode | Template                                        |
| ---------: | :---------------------------------------------- |
|  `default` | {{subject}} must consist only of consonants     |
| `inverted` | {{subject}} must not consist only of consonants |

### `Consonant::TEMPLATE_EXTRA`

|       Mode | Template                                                               |
| ---------: | :--------------------------------------------------------------------- |
|  `default` | {{subject}} must consist only of consonants or {{additionalChars}}     |
| `inverted` | {{subject}} must not consist only of consonants or {{additionalChars}} |

## Template placeholders

| Placeholder       | Description                                                      |
| ----------------- | ---------------------------------------------------------------- |
| `additionalChars` | Additional characters that are considered valid.                 |
| `subject`         | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                              |
| ------: | :--------------------------------------- |
|   3.0.0 | Templates changed                        |
|   0.5.0 | Renamed from `Consonants` to `Consonant` |
|   0.3.9 | Created as `Consonants`                  |

## See Also

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [Vowel](Vowel.md)
