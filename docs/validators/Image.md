<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Guilherme Siani <guilherme@siani.com.br>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Image

- `Image()`

Validates if the file is a valid image by checking its MIME type.

```php
v::image()->assert('/path/to/image.gif');
// Validation passes successfully

v::image()->assert('/path/to/image.jpg');
// Validation passes successfully

v::image()->assert('/path/to/image.png');
// Validation passes successfully
```

All the validations above must return `false` if the input is not a valid file
or of the MIME doesn't match with the file extension.

This validator relies on [fileinfo](http://php.net/fileinfo) PHP extension.

## Templates

### `Image::TEMPLATE_STANDARD`

|       Mode | Template                                                  |
| ---------: | :-------------------------------------------------------- |
|  `default` | {{subject}} must be an accessible existing image file     |
| `inverted` | {{subject}} must not be an accessible existing image file |

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
|   1.1.0 | Created           |

## See Also

- [Directory](Directory.md)
- [Executable](Executable.md)
- [Exists](Exists.md)
- [Extension](Extension.md)
- [File](File.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Writable](Writable.md)
