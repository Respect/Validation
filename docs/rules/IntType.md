# IntType

- `IntType()`

Validates whether the type of the input is [integer](http://php.net/types.integer).

```php
v::intType()->isValid(42); // true
v::intType()->isValid('10'); // false
```

## Templates

`IntType::TEMPLATE_STANDARD`

| Mode       | Template                        |
|------------|---------------------------------|
| `default`  | {{name}} must be an integer     |
| `inverted` | {{name}} must not be an integer |

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
- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [Finite](Finite.md)
- [FloatType](FloatType.md)
- [FloatVal](FloatVal.md)
- [Infinite](Infinite.md)
- [IntVal](IntVal.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [NumericVal](NumericVal.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
- [Type](Type.md)
