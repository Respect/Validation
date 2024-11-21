# File

- `File()`

Validates whether file input is as a regular filename.

```php
use Respect\Validation\Validator as v;

v::file()->validate(__FILE__); // true
v::file()->validate(__DIR__); // false
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
use Respect\Validation\Validator as v;

v::file()->validate(new SplFileInfo('file.txt'));
```

## Categorization

- File system

## Changelog

Version | Description
--------|-------------
  0.5.0 | Created

***
See also:

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
