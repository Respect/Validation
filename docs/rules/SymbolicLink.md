# SymbolicLink

- `SymbolicLink()`

Validates if the given input is a symbolic link.

```php
v::symbolicLink()->validate('/path/of/valid/symbolic/link'); // true
v::symbolicLink()->validate(new SplFileInfo('/path/of/valid/symbolic/link)); // true
v::symbolicLink()->validate(new SplFileObject('/path/of/valid/symbolic/link')); // true
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
- [File](File.md)
- [Image](Image.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [Size](Size.md)
- [Uploaded](Uploaded.md)
- [Writable](Writable.md)
