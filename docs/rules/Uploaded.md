# Uploaded

- `Uploaded()`

Validates if the given data is a file that was uploaded via HTTP POST.

```php
use Respect\Validation\Validator as v;

v::uploaded()->validate('/path/of/an/uploaded/file'); // true
```

## Categorization

- File system

## Changelog

Version | Description
--------|-------------
  2.1.0 | Add PSR-7 support
  0.5.0 | Created

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
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Writable](Writable.md)
