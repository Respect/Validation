# Directory

- `Directory()`

Validates if the given path is a directory.

```php
v::directory()->validate(__DIR__); // true
v::directory()->validate(__FILE__); // false
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::directory()->validate(new SplFileInfo('library/'));
v::directory()->validate(dir('/'));
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Validates PHP's `Directory` class
  0.4.4 | Created

***
See also:

- [Executable](Executable.md)
- [Exists](Exists.md)
- [Extension](Extension.md)
- [File](File.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Uploaded](Uploaded.md)
- [Writable](Writable.md)
