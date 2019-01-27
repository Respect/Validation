# Exists

- `Exists()`

Validates files or directories.

```php
v::exists()->validate(__FILE__); // true
v::exists()->validate(__DIR__); // true
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::exists()->validate(new SplFileInfo('file.txt'));
```

## Changelog

Version | Description
--------|-------------
  0.5.0 | Created

***
See also:

- [Directory](Directory.md)
- [Executable](Executable.md)
- [Extension](Extension.md)
- [File](File.md)
- [Image](Image.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Uploaded](Uploaded.md)
- [Writable](Writable.md)
