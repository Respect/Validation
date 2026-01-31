<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Size

- `Size("B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit, Validator $validator)`

Validates whether the input is a file that is of a certain size or not.

```php
v::size('KB', v::greaterThan(1))->assert('/path/to/file');
// Validation passes successfully

v::size('MB', v::between(1, 2))->assert('/path/to/file');
// → The size in megabytes of "/path/to/file" must be between 1 and 2

v::size('GB', v::lessThan(1))->assert('/path/to/file');
// Validation passes successfully
```

Accepted data storage units are `B`, `KB`, `MB`, `GB`, `TB`, `PB`, `EB`, `ZB`, and `YB`.

This validator will accept:

- `string` file paths
- `SplFileInfo` objects (see [SplFileInfo][])
- `Psr\Http\Message\UploadedFileInterface` objects (see [PSR-7][])
- `Psr\Http\Message\StreamInterface` objects (see [PSR-7][])

## Templates

### `Size::TEMPLATE_STANDARD`

|       Mode | Template                           |
| ---------: | :--------------------------------- |
|  `default` | The size in {{unit&#124;trans}} of |
| `inverted` | The size in {{unit&#124;trans}} of |

### `Size::TEMPLATE_WRONG_TYPE`

Used when the input is not a valid file path, a `SplFileInfo` object, or a PSR-7 interface.

|       Mode | Template                                                                              |
| ---------: | :------------------------------------------------------------------------------------ |
|  `default` | {{subject}} must be a filename or an instance of SplFileInfo or a PSR-7 interface     |
| `inverted` | {{subject}} must not be a filename or an instance of SplFileInfo or a PSR-7 interface |

## Template as prefix

The template serves as a prefix to the template of the inner validator.

```php
v::size('MB', v::equals(2))->assert('/path/to/file');
// → The size in megabytes of "/path/to/file" must be equal to 2

v::size('KB', v::not(v::equals(56)))->assert('/path/to/file');
// Validation passes successfully
```

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |
| `unit`      | The name of the storage unit (bytes, kilobytes, etc.)            |

## Categorization

- File system
- Transformations

## Changelog

| Version | Description             |
| ------: | :---------------------- |
|   3.0.0 | Became a transformation |
|   2.1.0 | Add [PSR-7][] support   |
|   1.0.0 | Created                 |

## See Also

- [Directory](Directory.md)
- [Executable](Executable.md)
- [Exists](Exists.md)
- [Extension](Extension.md)
- [File](File.md)
- [Image](Image.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [SymbolicLink](SymbolicLink.md)
- [Writable](Writable.md)

[PSR-7]: https://www.php-fig.org/psr/psr-7/
[SplFileInfo]: https://www.php.net/SplFileInfo
