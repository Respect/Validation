<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Writable

- `Writable()`

Validates if the given input is writable file.

```php
v::writable()->assert('/path/to/file');
// Validation passes successfully

v::writable()->assert('/path/to/non-writable');
// → "/path/to/non-writable" must be writable
```

## Templates

### `Writable::TEMPLATE_STANDARD`

|       Mode | Template                         |
| ---------: | :------------------------------- |
|  `default` | {{subject}} must be writable     |
| `inverted` | {{subject}} must not be writable |

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
- [Readable](Readable.md)
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Uploaded](Uploaded.md)
