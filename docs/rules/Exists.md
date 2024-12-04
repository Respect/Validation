# Exists

- `Exists()`

Validates files or directories.

```php
v::exists()->isValid(__FILE__); // true
v::exists()->isValid(__DIR__); // true
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::exists()->isValid(new SplFileInfo('file.txt'));
```

## Templates

`Exists::TEMPLATE_STANDARD`

| Mode       | Template                              |
|------------|---------------------------------------|
| `default`  | {{name}} must be an existing file     |
| `inverted` | {{name}} must not be an existing file |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- File system

## Changelog

| Version | Description |
|--------:|-------------|
|   0.5.0 | Created     |

***
See also:

- [Directory](Directory.md)
- [Executable](Executable.md)
- [Extension](Extension.md)
- [File](File.md)
- [Image](Image.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Uploaded](Uploaded.md)
- [Writable](Writable.md)
