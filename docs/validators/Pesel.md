<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# Pesel

- `Pesel()`

Validates PESEL (Polish human identification number).

```php
v::pesel()->assert('21120209256');
// Validation passes successfully

v::pesel()->assert('97072704800');
// Validation passes successfully

v::pesel()->assert('97072704801');
// → "97072704801" must be a valid PESEL

v::pesel()->assert('PESEL123456');
// → "PESEL123456" must be a valid PESEL
```

## Templates

### `Pesel::TEMPLATE_STANDARD`

|       Mode | Template                              |
| ---------: | :------------------------------------ |
|  `default` | {{subject}} must be a valid PESEL     |
| `inverted` | {{subject}} must not be a valid PESEL |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
| ------: | :---------- |
|   1.1.0 | Created     |

## See Also

- [Nip](Nip.md)
- [PolishIdCard](PolishIdCard.md)
- [SubdivisionCode](SubdivisionCode.md)
