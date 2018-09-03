# Image

- `Image()`
- `Image(finfo $fileInfo)`

Validates if the file is a valid image by checking its MIME type.

```php
v::image()->isValid('image.gif'); // true
v::image()->isValid('image.jpg'); // true
v::image()->isValid('image.png'); // true
```

All the validations above must return `false` if the input is not a valid file
or of the MIME doesn't match with the file extension.

This rule relies on [fileinfo](http://php.net/fileinfo) PHP extension.

## Changelog

Version | Description
--------|-------------
  1.1.0 | Created

***
See also:

- [Directory](Directory.md)
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
