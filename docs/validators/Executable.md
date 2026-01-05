# Executable

- `Executable()`

Validates if a file is an executable.

```php
v::executable()->isValid('script.sh'); // true
```

## Templates

### `Executable::TEMPLATE_STANDARD`

| Mode       | Template                                   |
| ---------- | ------------------------------------------ |
| `default`  | {{subject}} must be an executable file     |
| `inverted` | {{subject}} must not be an executable file |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- File system

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.7.0 | Created     |

---

See also:

- [Directory](Directory.md)
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
