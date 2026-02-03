<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# Vowel

- `Vowel()`
- `Vowel(string ...$additionalChars)`

Validates whether the input contains only vowels.

```php
v::vowel()->assert('aei');
// Validation passes successfully
```

## Templates

### `Vowel::TEMPLATE_STANDARD`

|       Mode | Template                                    |
| ---------: | :------------------------------------------ |
|  `default` | {{subject}} must consist of vowels only     |
| `inverted` | {{subject}} must not consist of vowels only |

### `Vowel::TEMPLATE_EXTRA`

|       Mode | Template                                                      |
| ---------: | :------------------------------------------------------------ |
|  `default` | {{subject}} must consist of vowels and {{additionalChars}}    |
| `inverted` | {{subject}} must not consist of vowels or {{additionalChars}} |

## Template placeholders

| Placeholder       | Description                                                      |
| ----------------- | ---------------------------------------------------------------- |
| `additionalChars` | Additional characters that are considered valid.                 |
| `subject`         | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                          |
| ------: | :----------------------------------- |
|   2.0.0 | Do not consider whitespaces as valid |
|   0.5.0 | Renamed from `Vowels` to `Vowel`     |
|   0.3.9 | Created as `Vowels`                  |

## See Also

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Consonant](Consonant.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
