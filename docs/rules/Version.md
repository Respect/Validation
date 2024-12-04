# Version

- `Version()`

Validates version numbers using Semantic Versioning.

```php
v::version()->isValid('1.0.0');
```

## Templates

`Version::TEMPLATE_STANDARD`

| Mode       | Template                       |
|------------|--------------------------------|
| `default`  | {{name}} must be a version     |
| `inverted` | {{name}} must not be a version |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description |
|--------:|-------------|
|   0.3.9 | Created     |

***
See also:

- [Equals](Equals.md)
- [Regex](Regex.md)
- [Roman](Roman.md)
