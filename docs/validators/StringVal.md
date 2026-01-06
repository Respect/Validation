# StringVal

- `StringVal()`

Validates whether the input can be used as a string.

```php
v::stringVal()->assert('6');
// Validation passes successfully

v::stringVal()->assert('String');
// Validation passes successfully

v::stringVal()->assert(1.0);
// Validation passes successfully

v::stringVal()->assert(42);
// Validation passes successfully

v::stringVal()->assert(false);
// Validation passes successfully

v::stringVal()->assert(true);
// Validation passes successfully

v::stringVal()->assert(new ClassWithToString()); if ClassWithToString implements `__toString`
// → syntax error, unexpected identifier "ClassWithToString", expecting "("
```

## Templates

### `StringVal::TEMPLATE_STANDARD`

| Mode       | Template                               |
| ---------- | -------------------------------------- |
| `default`  | {{subject}} must be a string value     |
| `inverted` | {{subject}} must not be a string value |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings
- Types

## Changelog

| Version | Description |
| ------: | ----------- |
|   2.0.0 | Created     |

---

See also:

- [Alnum](Alnum.md)
- [BoolType](BoolType.md)
- [CallableType](CallableType.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [NullType](NullType.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [Type](Type.md)
