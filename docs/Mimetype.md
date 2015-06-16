# Mimetype

- `v::mimetype(string $mimetype)`

Validates if the file mimetype matches the expected one:

```php
v::mimetype('image/png')->validate('image.png'); //true
```

This rule is case-sensitive and requires [fileinfo](http://php.net/fileinfo) PHP extension.

See also

  * [Executable](Executable.md)
  * [File](File.md)
  * [Readable](Readable.md)
  * [SymbolicLink](SymbolicLink.md)
  * [Uploaded](Uploaded.md)
  * [Writable](Writable.md)
