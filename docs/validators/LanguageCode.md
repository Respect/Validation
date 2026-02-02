<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# LanguageCode

- `LanguageCode()`
- `LanguageCode("alpha-2"|"alpha-3" $set)`

Validates whether the input is language code based on [ISO 639][].

**This validator requires [sokil/php-isocodes][] and [sokil/php-isocodes-db-only][] to be installed.**

```php
v::languageCode()->assert('pt');
// Validation passes successfully

v::languageCode()->assert('en');
// Validation passes successfully

v::languageCode()->assert('it');
// Validation passes successfully

v::languageCode('alpha-3')->assert('ita');
// Validation passes successfully

v::languageCode('alpha-3')->assert('eng');
// Validation passes successfully
```

This validator supports the two[ISO 639][] sets:

- `alpha-2`
- `alpha-3`

## Templates

### `LanguageCode::TEMPLATE_STANDARD`

|       Mode | Template                                |
| ---------: | :-------------------------------------- |
|  `default` | {{subject}} must be a language code     |
| `inverted` | {{subject}} must not be a language code |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- ISO codes
- Localization

## Changelog

| Version | Description                                                       |
| ------: | :---------------------------------------------------------------- |
|   3.0.0 | Templates changed                                                 |
|   3.0.0 | Require [sokil/php-isocodes][] and [sokil/php-isocodes-db-only][] |
|   1.1.0 | Created                                                           |

## See Also

- [CountryCode](CountryCode.md)

[ISO 639]: https://en.wikipedia.org/wiki/ISO_639-3
[sokil/php-isocodes]: https://github.com/sokil/php-isocodes
[sokil/php-isocodes-db-only]: https://github.com/sokil/php-isocodes-db-only
