# BoolType

- `BoolType()`

Validates whether the type of the input is [boolean](http://php.net/types.boolean).

```php
v::boolType()->isValid(true); // true
v::boolType()->isValid(false); // true
```

## Templates

### `BoolType::TEMPLATE_STANDARD`

| Mode       | Template                          |
| ---------- | --------------------------------- |
| `default`  | {{subject}} must be a boolean     |
| `inverted` | {{subject}} must not be a boolean |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Booleans
- Types

## Changelog

| Version | Description                       |
| ------: | --------------------------------- |
|   1.0.0 | Renamed from `Bool` to `BoolType` |
|   0.3.9 | Created as `Bool`                 |

---

See also:

- [ArrayType](ArrayType.md)
- [BoolVal](BoolVal.md)
- [CallableType](CallableType.md)
- [FloatType](FloatType.md)
- [FloatVal](FloatVal.md)
- [IntType](IntType.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
- [TrueVal](TrueVal.md)
- [Type](Type.md)
