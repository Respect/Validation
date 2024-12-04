# Base64

- `Base64()`

Validate if a string is Base64-encoded.

```php
v::base64()->isValid('cmVzcGVjdCE='); // true
v::base64()->isValid('respect!'); // false
```

## Templates

`Base64::TEMPLATE_STANDARD`

| Mode       | Template                                     |
|------------|----------------------------------------------|
| `default`  | {{name}} must be a base64 encoded string     |
| `inverted` | {{name}} must not be a base64 encoded string |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description |
|--------:|-------------|
|   2.0.0 | Created     |

***
See also:

- [Base](Base.md)
