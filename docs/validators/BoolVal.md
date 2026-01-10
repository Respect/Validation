# BoolVal

- `BoolVal()`

Validates if the input results in a boolean value:

```php
v::boolVal()->isValid('on'); // true
v::boolVal()->isValid('off'); // true
v::boolVal()->isValid('yes'); // true
v::boolVal()->isValid('no'); // true
v::boolVal()->isValid(1); // true
v::boolVal()->isValid(0); // true
```

## Templates

### `BoolVal::TEMPLATE_STANDARD`

| Mode       | Template                                |
| ---------- | --------------------------------------- |
| `default`  | {{subject}} must be a boolean value     |
| `inverted` | {{subject}} must not be a boolean value |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Booleans
- Types

## Changelog

| Version | Description |
| ------: | ----------- |
|   1.0.0 | Created     |

---

See also:

- [BoolType](BoolType.md)
- [CallableType](CallableType.md)
- [FloatType](FloatType.md)
- [FloatVal](FloatVal.md)
- [IntType](IntType.md)
- [NullType](NullType.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [TrueVal](TrueVal.md)
- [Type](Type.md)
