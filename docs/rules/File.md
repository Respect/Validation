# File

- `File()`

Validates whether file input is as a regular filename.

```php
v::file()->isValid(__FILE__); // true
v::file()->isValid(__DIR__); // false
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::file()->isValid(new SplFileInfo('file.txt'));
```

## Templates

### `File::TEMPLATE_STANDARD`

| Mode       | Template                         |
|------------|----------------------------------|
| `default`  | {{name}} must be a valid file    |
| `inverted` | {{name}} must be an invalid file |

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
- [Exists](Exists.md)
- [Extension](Extension.md)
- [Image](Image.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Uploaded](Uploaded.md)
- [Writable](Writable.md)
