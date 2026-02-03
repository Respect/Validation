<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# Executable

- `Executable()`

Validates if a file is an executable.

```php
v::executable()->assert('/path/to/executable');
// Validation passes successfully

v::executable()->assert('/path/to/file');
// → "/path/to/file" must be an executable file
```

## Templates

### `Executable::TEMPLATE_STANDARD`

|       Mode | Template                                   |
| ---------: | :----------------------------------------- |
|  `default` | {{subject}} must be an executable file     |
| `inverted` | {{subject}} must not be an executable file |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- File system

## Changelog

| Version | Description |
| ------: | :---------- |
|   0.7.0 | Created     |

## See Also

- [Directory](Directory.md)
- [Exists](Exists.md)
- [Extension](Extension.md)
- [File](File.md)
- [Image](Image.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Writable](Writable.md)
