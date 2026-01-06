# Emoji

- `v::emoji()`

Validates if the input is an emoji or a sequence of emojis.

```php
v::emoji()->assert('🍕');
// Validation passes successfully

v::emoji()->assert('🎈');
// Validation passes successfully

v::emoji()->assert('⚡');
// Validation passes successfully

v::emoji()->assert('🌊🌊🌊🌊🌊🏄🌊🌊🌊🏖🌴');
// Validation passes successfully

v::emoji()->assert('🇧🇷'); (country flag)
// → syntax error, unexpected identifier "flag"

v::emoji()->assert('👨‍👩‍👧‍👦'); (ZWJ sequence)
// → syntax error, unexpected identifier "sequence"

v::emoji()->assert('👩🏽'); (skin tone modifier)
// → syntax error, unexpected identifier "tone"

v::emoji()->assert('1️⃣'); (keycap sequence)
// → syntax error, unexpected identifier "sequence"

v::emoji()->assert('Hello World');
// → "Hello World" must be an emoji

v::emoji()->assert('this is a spark ⚡'); (mixed content)
// → syntax error, unexpected identifier "content"
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
