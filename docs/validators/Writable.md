<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Writable

- `Writable()`

Validates if the given input is writable file.

```php
v::writable()->assert('/path/to/file');
// Validation passes successfully

v::writable()->assert('/path/to/non-writable');
// → "/path/to/non-writable" must be an accessible existing writable filesystem entry
```

## Templates

### `Writable::TEMPLATE_STANDARD`

|       Mode | Template                                                                 |
| ---------: | :----------------------------------------------------------------------- |
|  `default` | {{subject}} must be an accessible existing writable filesystem entry     |
| `inverted` | {{subject}} must not be an accessible existing writable filesystem entry |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- File system

## Changelog

| Version | Description       |
| ------: | :---------------- |
|   3.0.0 | Templates changed |
|   2.1.0 | Add PSR-7 support |
|   0.5.0 | Created           |

## See Also

- [Directory](Directory.md)
- [Executable](Executable.md)
- [Exists](Exists.md)
- [Extension](Extension.md)
- [File](File.md)
- [Image](Image.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
