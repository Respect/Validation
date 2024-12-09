# Json

- `Json()`

Validates if the given input is a valid JSON.

```php
v::json()->isValid('{"foo":"bar"}'); // true
```

## Templates

### `Json::TEMPLATE_STANDARD`

| Mode       | Template                                 |
|------------|------------------------------------------|
| `default`  | {{name}} must be a valid JSON string     |
| `inverted` | {{name}} must not be a valid JSON string |

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

- [Domain](Domain.md)
- [Email](Email.md)
- [FilterVar](FilterVar.md)
- [Phone](Phone.md)
- [VideoUrl](VideoUrl.md)
