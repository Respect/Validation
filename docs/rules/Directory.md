# Directory

- `v::directory()`

Validates directories.

```php
v::directory()->validate(__DIR__); // true
v::directory()->validate(__FILE__); // false
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::directory()->validate(new \SplFileInfo($directory));
```

***
See also:

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
