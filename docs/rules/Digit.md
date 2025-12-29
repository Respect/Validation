# Digit

- `Digit()`
- `Digit(string ...$additionalChars)`

Validates whether the input contains only digits.

```php
v::digit()->isValid('020 612 1851'); // false
v::digit(' ')->isValid('020 612 1851'); // true
v::digit()->isValid('172.655.537-21'); // false
v::digit('.', '-')->isValid('172.655.537-21'); // true
```

## Templates

### `Digit::TEMPLATE_STANDARD`

| Mode       | Template                                   |
| ---------- | ------------------------------------------ |
| `default`  | {{subject}} must contain only digits (0-9) |
| `inverted` | {{subject}} must not contain digits (0-9)  |

### `Digit::TEMPLATE_EXTRA`

| Mode       | Template                                                           |
| ---------- | ------------------------------------------------------------------ |
| `default`  | {{subject}} must contain only digits (0-9) and {{additionalChars}} |
| `inverted` | {{subject}} must not contain digits (0-9) and {{additionalChars}}  |

## Template placeholders

| Placeholder       | Description                                                      |
| ----------------- | ---------------------------------------------------------------- |
| `additionalChars` | Additional characters that are considered valid.                 |
| `subject`         | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers
- Strings

## Changelog

| Version | Description                               |
| ------: | ----------------------------------------- |
|   2.0.0 | Removed support to whitespaces by default |
|   0.5.0 | Renamed from `Digits` to `Digit`          |
|   0.3.9 | Created as `Digits`                       |

---

See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Consonant](Consonant.md)
- [CreditCard](CreditCard.md)
- [Emoji](Emoji.md)
- [Factor](Factor.md)
- [Finite](Finite.md)
- [Infinite](Infinite.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [NumericVal](NumericVal.md)
- [Regex](Regex.md)
- [Uuid](Uuid.md)
- [Vowel](Vowel.md)
- [Xdigit](Xdigit.md)
