<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Gus Antoniassi <gus.antoniassi@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# SymbolicLink

- `SymbolicLink()`

Validates if the given input is a symbolic link.

```php
v::symbolicLink()->assert('/path/to/symbolic-link');
// Validation passes successfully

v::symbolicLink()->assert(new SplFileInfo('/path/to/file'));
// → `SplFileInfo { __toString() => "/path/to/file" }` must be an accessible existing symbolic link

v::symbolicLink()->assert(new SplFileObject('/path/to/file'));
// → `SplFileObject { current() => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nec enim vitae ve ... }` must be an accessible existing symbolic link
```

## Templates

### `SymbolicLink::TEMPLATE_STANDARD`

|       Mode | Template                                                     |
| ---------: | :----------------------------------------------------------- |
|  `default` | {{subject}} must be an accessible existing symbolic link     |
| `inverted` | {{subject}} must not be an accessible existing symbolic link |

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
- [Writable](Writable.md)
