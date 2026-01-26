<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Roman

- `Roman()`

Validates if the input is a Roman numeral.

```php
v::roman()->assert('IV');
// Validation passes successfully
```

## Templates

### `Roman::TEMPLATE_STANDARD`

|       Mode | Template                                      |
| ---------: | :-------------------------------------------- |
|  `default` | {{subject}} must be a valid Roman numeral     |
| `inverted` | {{subject}} must not be a valid Roman numeral |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers

## Changelog

| Version | Description                                                       |
| ------: | :---------------------------------------------------------------- |
|   2.0.0 | Exception message refers to Roman "numerals" instead of "numbers" |
|   2.0.0 | Do not consider empty strings as valid                            |
|   0.3.9 | Created                                                           |

## See Also

- [In](In.md)
- [Regex](Regex.md)
- [Uppercase](Uppercase.md)
- [Version](Version.md)
