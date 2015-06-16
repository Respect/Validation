# Extension

- `v::extension(string $extension)`

Validates if the file extension matches the expected one:

```php
v::extension('png')->validate('image.png'); //true
```

This rule is case-sensitive.

See also:

  * [Executable](Executable.md)
  * [File](File.md)
  * [Readable](Readable.md)
  * [SymbolicLink](SymbolicLink.md)
  * [Uploaded](Uploaded.md)
  * [Writable](Writable.md)
