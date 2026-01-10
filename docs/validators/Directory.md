# Directory

- `Directory()`

Validates if the given path is a directory.

```php
v::directory()->assert(__DIR__);
// Validation passes successfully

v::directory()->assert(__FILE__);
// → "/path/to/file" must be a directory
```

This validator will consider SplFileInfo instances, so you can do something like:

```php
v::directory()->assert(new SplFileInfo('library/'));
// Validation passes successfully

v::directory()->assert(dir('/'));
// Validation passes successfully
```

## Templates

### `Directory::TEMPLATE_STANDARD`

| Mode       | Template                            |
| ---------- | ----------------------------------- |
| `default`  | {{subject}} must be a directory     |
| `inverted` | {{subject}} must not be a directory |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- File system

## Changelog

| Version | Description                       |
| ------: | --------------------------------- |
|   2.0.0 | Validates PHP's `Directory` class |
|   0.4.4 | Created                           |

---

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
