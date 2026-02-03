<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
SPDX-FileContributor: Moritz <moritzgitfromm@gmail.com>
-->

# Isbn

- `Isbn()`

Validates whether the input is a valid [ISBN][] or not.

```php
v::isbn()->assert('ISBN-13: 978-0-596-52068-7');
// Validation passes successfully

v::isbn()->assert('978 0 596 52068 7');
// Validation passes successfully

v::isbn()->assert('ISBN-12: 978-0-596-52068-7');
// → "ISBN-12: 978-0-596-52068-7" must be a valid ISBN

v::isbn()->assert('978 10 596 52068 7');
// → "978 10 596 52068 7" must be a valid ISBN
```

## Templates

### `Isbn::TEMPLATE_STANDARD`

|       Mode | Template                             |
| ---------: | :----------------------------------- |
|  `default` | {{subject}} must be a valid ISBN     |
| `inverted` | {{subject}} must not be a valid ISBN |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
| ------: | :---------- |
|   2.0.0 | Created     |

## See Also

- [Imei](Imei.md)
- [Luhn](Luhn.md)

[ISBN]: https://www.isbn-international.org/content/what-isbn "International Standard Book Number"
