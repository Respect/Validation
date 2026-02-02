<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Extension

- `Extension(string $extension)`

Validates if the file extension matches the expected one:

```php
v::extension('png')->assert('image.png');
// Validation passes successfully
```

This validator is case-sensitive.

## Templates

### `Extension::TEMPLATE_STANDARD`

|       Mode | Template                                              |
| ---------: | :---------------------------------------------------- |
|  `default` | {{subject}} must have the {{extension}} extension     |
| `inverted` | {{subject}} must not have the {{extension}} extension |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `extension` |                                                                  |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- File system

## Changelog

| Version | Description       |
| ------: | :---------------- |
|   3.0.0 | Templates changed |
|   1.0.0 | Created           |

## See Also

- [Directory](Directory.md)
- [Executable](Executable.md)
- [Exists](Exists.md)
- [File](File.md)
- [Image](Image.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Writable](Writable.md)
