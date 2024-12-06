# Size

- `Size(string $unit, Rule $rule)`

Validates whether the input is a file that is of a certain size or not.

```php
v::size('KB', v::greaterThan(1))->isValid($filename);
v::size('MB', v::between(1, 2))->isValid($filename);
v::size('GB', v::lessThan(1))->isValid($filename);
```

Accepted data storage units are `B`, `KB`, `MB`, `GB`, `TB`, `PB`, `EB`, `ZB`, and `YB`.

This validator will accept:

* `string` file paths
* `SplFileInfo` objects (see [SplFileInfo][])
* `Psr\Http\Message\UploadedFileInterface` objects (see [PSR-7][])
* `Psr\Http\Message\StreamInterface` objects (see [PSR-7][])

## Templates

### `Size::TEMPLATE_STANDARD`

| Mode       | Template                           |
|------------|------------------------------------|
| `default`  | The size in {{unit&#124;trans}} of |
| `inverted` | The size in {{unit&#124;trans}} of |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |
| `unit`      | The name of the storage unit (bytes, kilobytes, etc.)            |

## Categorization

- File system
- Transformations

## Changelog

| Version | Description             |
|--------:|-------------------------|
|   3.0.0 | Became a transformation |
|   2.1.0 | Add [PSR-7][] support   |
|   1.0.0 | Created                 |

***
See also:

- [Directory](Directory.md)
- [Executable](Executable.md)
- [Exists](Exists.md)
- [Extension](Extension.md)
- [File](File.md)
- [Image](Image.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [SymbolicLink](SymbolicLink.md)
- [Uploaded](Uploaded.md)
- [Writable](Writable.md)

[PSR-7]: https://www.php-fig.org/psr/psr-7/
[SplFileInfo]: https://www.php.net/SplFileInfo
