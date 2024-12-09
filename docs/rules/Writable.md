# Writable

- `Writable()`

Validates if the given input is writable file.

```php
v::writable()->isValid('file.txt'); // true
```

## Templates

### `Writable::TEMPLATE_STANDARD`

| Mode       | Template                      |
|------------|-------------------------------|
| `default`  | {{name}} must be writable     |
| `inverted` | {{name}} must not be writable |

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
- [Uploaded](Uploaded.md)
