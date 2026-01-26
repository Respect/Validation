<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Uploaded

- `Uploaded()`

Validates if the given data is a file that was uploaded via HTTP POST.

```php
v::uploaded()->assert('/path/of/an/uploaded/file');
// → "/path/of/an/uploaded/file" must be an uploaded file
```

## Templates

### `Uploaded::TEMPLATE_STANDARD`

|       Mode | Template                                 |
| ---------: | :--------------------------------------- |
|  `default` | {{subject}} must be an uploaded file     |
| `inverted` | {{subject}} must not be an uploaded file |

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
- [Writable](Writable.md)
