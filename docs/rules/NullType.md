# NullType

- `NullType()`

Validates whether the input is [null](http://php.net/types.null).

```php
v::nullType()->isValid(null); // true
```

## Templates

### `NullType::TEMPLATE_STANDARD`

| Mode       | Template                     |
| ---------- | ---------------------------- |
| `default`  | {{subject}} must be null     |
| `inverted` | {{subject}} must not be null |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Types

## Changelog

| Version | Description                            |
| ------: | -------------------------------------- |
|   1.0.0 | Renamed from `NullValue` to `NullType` |
|   0.3.9 | Created as `NullValue`                 |

---

See also:

- [ArrayType](ArrayType.md)
- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [CallableType](CallableType.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [NotBlank](NotBlank.md)
- [NotEmpty](NotEmpty.md)
- [NotUndef](NotUndef.md)
- [NullOr](NullOr.md)
- [Number](Number.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
- [Type](Type.md)
- [UndefOr](UndefOr.md)
