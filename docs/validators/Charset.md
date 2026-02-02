<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Charset

- `Charset(string $charset)`
- `Charset(string $charset, string ...$charsets)`

Validates if a string is in a specific charset.

```php
v::charset('ASCII')->assert('sugar');
// Validation passes successfully

v::charset('ASCII')->assert('açúcar');
// → "açúcar" must consist only of characters from the "ASCII" character-set

v::charset('ISO-8859-1', 'EUC-JP')->assert('日本国');
// Validation passes successfully
```

The array format is a logic OR, not AND.

## Templates

### `Charset::TEMPLATE_STANDARD`

|       Mode | Template                                                                                        |
| ---------: | :---------------------------------------------------------------------------------------------- |
|  `default` | {{subject}} must consist only of characters from the {{charset&#124;list:or}} character-set     |
| `inverted` | {{subject}} must not consist only of characters from the {{charset&#124;list:or}} character-set |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `charset`   |                                                                  |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                                           |
| ------: | :---------------------------------------------------- |
|   3.0.0 | Templates changed                                     |
|   2.0.0 | Charset supports multiple charsets on its constructor |
|   0.5.0 | Created                                               |

## See Also

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
