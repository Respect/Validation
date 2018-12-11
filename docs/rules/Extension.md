# Extension

- `v::extension(string $extension)`

Validates if the file extension matches the expected one:

```php
v::extension('png')->validate('image.png'); // true
```

This rule is case-sensitive.

***
See also:

  * [Directory](Directory.md)
  * [Executable](Executable.md)
  * [Exists](Exists.md)
  * [File](File.md)
  * [Image](Image.md)
  * [Mimetype](Mimetype.md)
  * [Readable](Readable.md)
  * [Size](Size.md)
  * [SymbolicLink](SymbolicLink.md)
  * [Uploaded](Uploaded.md)
  * [Writable](Writable.md)
