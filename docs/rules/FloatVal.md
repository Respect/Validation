# FloatVal

- `FloatVal()`

Validate whether the input value is float.

```php
v::floatVal()->isValid(1.5); // true
v::floatVal()->isValid('1e5'); // true
```

## Templates

### `FloatVal::TEMPLATE_STANDARD`

| Mode       | Template                           |
|------------|------------------------------------|
| `default`  | {{name}} must be a float value     |
| `inverted` | {{name}} must not be a float value |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers
- Types

## Changelog

| Version | Description |
|--------:|-------------|
|   1.0.0 | Created     |

***
See also:

- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [Type](Type.md)
