# Extension

- `Extension(string $extension)`

Validates if the file extension matches the expected one:

```php
v::extension('png')->isValid('image.png'); // true
```

This rule is case-sensitive.

## Templates

`Extension::TEMPLATE_STANDARD`

| Mode       | Template                                       |
|------------|------------------------------------------------|
| `default`  | {{name}} must have {{extension}} extension     |
| `inverted` | {{name}} must not have {{extension}} extension |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `extension` |                                                                  |
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- File system

## Changelog

| Version | Description |
|--------:|-------------|
|   1.0.0 | Created     |

***
See also:

- [Directory](Directory.md)
- [Executable](Executable.md)
- [Exists](Exists.md)
- [File](File.md)
- [Image](Image.md)
- [Mimetype](Mimetype.md)
- [Readable](Readable.md)
- [Size](Size.md)
- [SymbolicLink](SymbolicLink.md)
- [Uploaded](Uploaded.md)
- [Writable](Writable.md)
