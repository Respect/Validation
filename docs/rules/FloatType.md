# FloatType

- `FloatType()`

Validates whether the type of the input is [float](http://php.net/types.float).

```php
v::floatType()->isValid(1.5); // true
v::floatType()->isValid('1.5'); // false
v::floatType()->isValid(0e5); // true
```

## Templates

`FloatType::TEMPLATE_STANDARD`

| Mode       | Template                   |
|------------|----------------------------|
| `default`  | {{name}} must be float     |
| `inverted` | {{name}} must not be float |

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

- [ArrayType](ArrayType.md)
- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [CallableType](CallableType.md)
- [FloatVal](FloatVal.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [NumericVal](NumericVal.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
- [Type](Type.md)
