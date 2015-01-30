# File

- `v::file()`

Validates files.

```php
v::file()->validate(__FILE__); //true
v::file()->validate(__DIR__); //false
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::file()->validate(new \SplFileInfo($file));
```

See also

  * [Directory](Directory.md)
  * [Exists](Exists.md)
