# Directory

- `Directory()`

Validates if the given path is a directory.

```php
v::directory()->isValid(__DIR__); // true
v::directory()->isValid(__FILE__); // false
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::directory()->isValid(new SplFileInfo('library/'));
v::directory()->isValid(dir('/'));
```

## Templates

`Directory::TEMPLATE_STANDARD`

| Mode       | Template                         |
|------------|----------------------------------|
| `default`  | {{name}} must be a directory     |
| `inverted` | {{name}} must not be a directory |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- File system

## Changelog

| Version | Description                       |
|--------:|-----------------------------------|
|   2.0.0 | Validates PHP's `Directory` class |
|   0.4.4 | Created                           |

***
See also:

- [Executable](Executable.md)
- [Exists](Exists.md)
- [Extension](Extension.md)
- [File](File.md)
- [Image](Image.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Uploaded](Uploaded.md)
- [Writable](Writable.md)
