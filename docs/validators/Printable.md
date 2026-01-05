# Printable

- `Printable()`
- `Printable(string ...$additionalChars)`

Similar to `Graph` but accepts whitespace.

```php
v::printable()->isValid('LMKA0$% _123'); // true
```

## Templates

### `Printable::TEMPLATE_STANDARD`

| Mode       | Template                                           |
| ---------- | -------------------------------------------------- |
| `default`  | {{subject}} must contain only printable characters |
| `inverted` | {{subject}} must not contain printable characters  |

### `Printable::TEMPLATE_EXTRA`

| Mode       | Template                                                                   |
| ---------- | -------------------------------------------------------------------------- |
| `default`  | {{subject}} must contain only printable characters and {{additionalChars}} |
| `inverted` | {{subject}} must not contain printable characters or {{additionalChars}}   |

## Template placeholders

| Placeholder       | Description                                                      |
| ----------------- | ---------------------------------------------------------------- |
| `additionalChars` | Additional characters that are considered valid.                 |
| `subject`         | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.5.0 | Created     |

---

See also:

- [Control](Control.md)
- [Graph](Graph.md)
- [Punct](Punct.md)
