# File

- `v::file()`

Validates files.

```php
v::file()->validate(__FILE__); // true
v::file()->validate(__DIR__); // false
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::file()->validate(new \SplFileInfo($file));
```

***
See also:

  * [Directory](Directory.md)
  * [Executable](Executable.md)
  * [Exists](Exists.md)
  * [Extension](Extension.md)
  * [Mimetype](Mimetype.md)
  * [Readable](Readable.md)
  * [Size](Size.md)
  * [SymbolicLink](SymbolicLink.md)
  * [Uploaded](Uploaded.md)
  * [Writable](Writable.md)
