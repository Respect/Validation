# Graph

- `Graph()`
- `Graph(string ...$additionalChars)`

Validates if all characters in the input are printable and actually creates
visible output (no white space).

```php
v::graph()->isValid('LKM@#$%4;'); // true
```

## Templates

### `Graph::TEMPLATE_STANDARD`

| Mode       | Template                                        |
|------------|-------------------------------------------------|
| `default`  | {{name}} must contain only graphical characters |
| `inverted` | {{name}} must not contain graphical characters  |

### `Graph::TEMPLATE_EXTRA`

| Mode       | Template                                                                |
|------------|-------------------------------------------------------------------------|
| `default`  | {{name}} must contain only graphical characters and {{additionalChars}} |
| `inverted` | {{name}} must not contain graphical characters or {{additionalChars}}   |

## Template placeholders

| Placeholder       | Description                                                      |
|-------------------|------------------------------------------------------------------|
| `additionalChars` | Additional characters that are considered valid.                 |
| `name`            | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description |
|--------:|-------------|
|   0.5.0 | Created     |

***
See also:

- [Printable](Printable.md)
- [Punct](Punct.md)
