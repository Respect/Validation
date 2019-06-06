# Size

- `Size(string $minSize)`
- `Size(string $minSize, string $maxSize)`
- `Size(null, string $maxSize)`

Validates whether the input is a file that is of a certain size or not.

```php
v::size('1KB')->validate($filename); // Must have at least 1KB size
v::size('1MB', '2MB')->validate($filename); // Must have the size between 1MB and 2MB
v::size(null, '1GB')->validate($filename); // Must not be greater than 1GB
```

Sizes are not case-sensitive and the accepted values are:

- B
- KB
- MB
- GB
- TB
- PB
- EB
- ZB
- YB

This validator will consider `SplFileInfo` instances, like:

```php
v::size('1.5mb')->validate(new SplFileInfo($filename)); // Will return true or false
```

Message template for this validator includes `{{minSize}}` and `{{maxSize}}`.

## Categorization

- File system

## Changelog

Version | Description
--------|-------------
  2.1.0 | Add PSR-7 support
  1.0.0 | Created

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
