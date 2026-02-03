<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
SPDX-FileContributor: Paul Karikari <paulkarikari1@gmail.com>
-->

# Even

- `Even()`

Validates whether the input is an even number or not.

```php
v::intVal()->even()->assert(2);
// Validation passes successfully
```

Using `int()` before `even()` is a best practice.

## Templates

### `Even::TEMPLATE_STANDARD`

|       Mode | Template                           |
| ---------: | :--------------------------------- |
|  `default` | {{subject}} must be an even number |
| `inverted` | {{subject}} must be an odd number  |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers

## Changelog

| Version | Description |
| ------: | :---------- |
|   0.3.9 | Created     |

## See Also

- [Multiple](Multiple.md)
- [Odd](Odd.md)
