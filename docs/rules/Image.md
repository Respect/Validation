# Image

- `v::image()`
- `v::image(finfo $fileInfo)`

Validates if the file is a valid image by checking its MIME type.

```php
v::image()->validate('image.gif'); // true
v::image()->validate('image.jpg'); // true
v::image()->validate('image.png'); // true
```

All the validations above must return `false` if the input is not a valid file
or of the MIME doesn't match with the file extension.

This rule relies on [fileinfo](http://php.net/fileinfo) PHP extension.

***
See also:

  * [Directory](Directory.md)
  * [Executable](Executable.md)
  * [Exists](Exists.md)
  * [Extension](Extension.md)
  * [File](File.md)
  * [Mimetype](Mimetype.md)
  * [Readable](Readable.md)
  * [Size](Size.md)
  * [SymbolicLink](SymbolicLink.md)
  * [Uploaded](Uploaded.md)
  * [Writable](Writable.md)
