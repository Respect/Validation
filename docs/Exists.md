# Exists

- `v::exists()`

Validates files or directories.

```php
v::exists()->validate(__FILE__); // true
v::exists()->validate(__DIR__); // true
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::exists()->validate(new \SplFileInfo($file));
```

***
See also:

  * [Directory](Directory.md)
  * [Executable](Executable.md)
  * [Extension](Extension.md)
  * [File](File.md)
  * [Mimetype](Mimetype.md)
  * [Readable](Readable.md)
  * [Size](Size.md)
  * [SymbolicLink](SymbolicLink.md)
  * [Uploaded](Uploaded.md)
  * [Writable](Writable.md)
