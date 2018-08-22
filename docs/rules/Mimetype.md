# Mimetype

- `v::mimetype(string $mimetype)`

Validates if the file mimetype matches the expected one:

```php
v::mimetype('image/png')->validate('image.png'); // true
```

This rule is case-sensitive and requires [fileinfo](http://php.net/fileinfo) PHP extension.

***
See also:

  * [Directory](Directory.md)
  * [Executable](Executable.md)
  * [Exists](Exists.md)
  * [Extension](Extension.md)
  * [File](File.md)
  * [Readable](Readable.md)
  * [Size](Size.md)
  * [SymbolicLink](SymbolicLink.md)
  * [Uploaded](Uploaded.md)
  * [Writable](Writable.md)
