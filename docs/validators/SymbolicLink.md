# SymbolicLink

- `SymbolicLink()`

Validates if the given input is a symbolic link.

```php
v::symbolicLink()->assert('/path/to/file.txt');
// → "/path/to/file.txt" must be a symbolic link

v::symbolicLink()->assert(new SplFileInfo('/path/to/file.txt'));
// → SplFileObject::__construct(/path/to/file.txt): Failed to open stream: No such file or directory

v::symbolicLink()->assert(new SplFileObject('/path/to/file.txt'));
// → SplFileObject::__construct(/path/to/file.txt): Failed to open stream: No such file or directory
```

## Templates

### `SymbolicLink::TEMPLATE_STANDARD`

| Mode       | Template                                |
| ---------- | --------------------------------------- |
| `default`  | {{subject}} must be a symbolic link     |
| `inverted` | {{subject}} must not be a symbolic link |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- File system

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.5.0 | Created     |

---

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
- [Uploaded](Uploaded.md)
- [Writable](Writable.md)
