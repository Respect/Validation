# Slug

- `Slug()`

Validates whether the input is a valid slug.

```php
v::slug()->isValid('my-wordpress-title'); // true
v::slug()->isValid('my-wordpress--title'); // false
v::slug()->isValid('my-wordpress-title-'); // false
```

## Templates

### `Slug::TEMPLATE_STANDARD`

| Mode       | Template                             |
| ---------- | ------------------------------------ |
| `default`  | {{subject}} must be a valid slug     |
| `inverted` | {{subject}} must not be a valid slug |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.3.9 | Created     |

---

See also:

- [PhpLabel](PhpLabel.md)
- [Url](Url.md)
- [VideoUrl](VideoUrl.md)
