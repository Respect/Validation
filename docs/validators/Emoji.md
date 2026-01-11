# Emoji

- `Emoji()`

Validates if the input is an emoji or a sequence of emojis.

```php
v::emoji()->isValid('🍕'); // true
v::emoji()->isValid('🎈'); // true
v::emoji()->isValid('⚡'); // true
v::emoji()->isValid('🌊🌊🌊🌊🌊🏄🌊🌊🌊🏖🌴'); // true
v::emoji()->isValid('🇧🇷'); // true (country flag)
v::emoji()->isValid('👨‍👩‍👧‍👦'); // true (ZWJ sequence)
v::emoji()->isValid('👩🏽'); // true (skin tone modifier)
v::emoji()->isValid('1️⃣'); // true (keycap sequence)
v::emoji()->isValid('Hello World'); // false
v::emoji()->isValid('this is a spark ⚡'); // false (mixed content)
```

This validator supports:

- Basic emojis and pictographs
- Skin tone modifiers (Fitzpatrick scale)
- Country flags (regional indicator sequences)
- Subdivision flags (tag sequences like 🏴󠁧󠁢󠁥󠁮󠁧󠁿)
- Keycap sequences (0️⃣-9️⃣, #️⃣, \*️⃣)
- ZWJ (Zero Width Joiner) sequences for families, professions, and combined emojis
- Emojis up to Unicode 17.0 / Emoji 16.0

## Templates

### `Emoji::TEMPLATE_STANDARD`

| Mode       | Template                         |
| ---------- | -------------------------------- |
| `default`  | {{subject}} must be an emoji     |
| `inverted` | {{subject}} must not be an emoji |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                                                                 |
| ------: | --------------------------------------------------------------------------- |
|   3.0.0 | Renamed to `Emoji`, changed the behavior, and added support for more emojis |
|   2.0.0 | Created as `NotEmoji`                                                       |

---

See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
