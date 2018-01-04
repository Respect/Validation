# Directory

- `Directory()`

Validates directories.

```php
v::directory()->isValid(__DIR__); // true
v::directory()->isValid(__FILE__); // false
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::directory()->isValid(new \SplFileInfo($directory));
```

## Changelog

Version | Description
--------|-------------
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
