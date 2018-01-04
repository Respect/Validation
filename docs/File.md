# File

- `File()`

Validates files.

```php
v::file()->isValid(__FILE__); // true
v::file()->isValid(__DIR__); // false
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::file()->isValid(new \SplFileInfo($file));
```

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
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Uploaded](Uploaded.md)
- [Writable](Writable.md)
