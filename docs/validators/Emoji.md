<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Emoji

- `Emoji()`

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

v::emoji()->assert('🇧🇷'); // (Country flags)
// Validation passes successfully

v::emoji()->assert('👨‍👩‍👧‍👦'); // (ZWJ sequence)
// Validation passes successfully

v::emoji()->assert('👩🏽'); // (Skin tone modifier)
// Validation passes successfully

v::emoji()->assert('1️⃣'); // (Keycap sequence)
// Validation passes successfully

v::emoji()->assert('Hello World');
// → "Hello World" must be an emoji

v::emoji()->assert('this is a spark ⚡'); // (Mixed content)
// → "this is a spark ⚡" must be an emoji
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

|       Mode | Template                         |
| ---------: | :------------------------------- |
|  `default` | {{subject}} must be an emoji     |
| `inverted` | {{subject}} must not be an emoji |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                                                                 |
| ------: | :-------------------------------------------------------------------------- |
|   3.0.0 | Renamed to `Emoji`, changed the behavior, and added support for more emojis |
|   2.0.0 | Created as `NotEmoji`                                                       |

## See Also

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
