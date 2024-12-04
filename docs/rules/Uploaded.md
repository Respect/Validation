# Uploaded

- `Uploaded()`

Validates if the given data is a file that was uploaded via HTTP POST.

```php
v::uploaded()->isValid('/path/of/an/uploaded/file'); // true
```

## Templates

`Uploaded::TEMPLATE_STANDARD`

| Mode       | Template                              |
|------------|---------------------------------------|
| `default`  | {{name}} must be an uploaded file     |
| `inverted` | {{name}} must not be an uploaded file |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- File system

## Changelog

| Version | Description       |
|--------:|-------------------|
|   2.1.0 | Add PSR-7 support |
|   0.5.0 | Created           |

***
See also:

- [Directory](Directory.md)
- [Executable](Executable.md)
- [Exists](Exists.md)
- [Extension](Extension.md)
- [File](File.md)
- [Image](Image.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Writable](Writable.md)
