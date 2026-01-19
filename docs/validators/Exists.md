<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Exists

- `Exists()`

Validates files or directories.

```php
v::exists()->assert(__FILE__);
// Validation passes successfully

v::exists()->assert(__DIR__);
// Validation passes successfully
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::exists()->assert(new SplFileInfo('/path/to/file.txt'));
// Validation passes successfully
```

## Templates

### `Exists::TEMPLATE_STANDARD`

| Mode       | Template                                 |
| ---------- | ---------------------------------------- |
| `default`  | {{subject}} must be an existing file     |
| `inverted` | {{subject}} must not be an existing file |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- File system

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.5.0 | Created     |

---

See also:

- [Directory](Directory.md)
- [Executable](Executable.md)
- [Extension](Extension.md)
- [File](File.md)
- [Image](Image.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Uploaded](Uploaded.md)
- [Writable](Writable.md)
