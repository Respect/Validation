<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Readable

- `Readable()`

Validates if the given data is a file exists and is readable.

```php
v::readable()->assert('/path/to/file.txt');
// Validation passes successfully
```

## Templates

### `Readable::TEMPLATE_STANDARD`

|       Mode | Template                         |
| ---------: | :------------------------------- |
|  `default` | {{subject}} must be readable     |
| `inverted` | {{subject}} must not be readable |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- File system

## Changelog

| Version | Description       |
| ------: | :---------------- |
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
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Writable](Writable.md)
