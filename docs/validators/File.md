<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# File

- `File()`

Validates whether file input is as a regular filename.

```php
v::file()->assert(__FILE__);
// Validation passes successfully

v::file()->assert(__DIR__);
// → "/path/to/dir" must be a valid file
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::file()->assert(new SplFileInfo('/path/to/file.txt'));
// Validation passes successfully
```

## Templates

### `File::TEMPLATE_STANDARD`

|       Mode | Template                            |
| ---------: | :---------------------------------- |
|  `default` | {{subject}} must be a valid file    |
| `inverted` | {{subject}} must be an invalid file |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- File system

## Changelog

| Version | Description |
| ------: | :---------- |
|   0.5.0 | Created     |

## See Also

- [Directory](Directory.md)
- [Executable](Executable.md)
- [Exists](Exists.md)
- [Extension](Extension.md)
- [Image](Image.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Uploaded](Uploaded.md)
- [Writable](Writable.md)
