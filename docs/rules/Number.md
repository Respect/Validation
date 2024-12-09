# Number

- `Number()`

Validates if the input is a number.

```php
v::number()->isValid(42); // true
v::number()->isValid(acos(8)); // false
```

> "In computing, NaN, standing for not a number, is a numeric data type value
> representing an undefined or unrepresentable value, especially in
> floating-point calculations." [Wikipedia](https://en.wikipedia.org/wiki/NaN)

## Templates

### `Number::TEMPLATE_STANDARD`

| Mode       | Template                        |
|------------|---------------------------------|
| `default`  | {{name}} must be a valid number |
| `inverted` | {{name}} must not be a number   |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers

## Changelog

| Version | Description |
|--------:|-------------|
|   2.0.0 | Created     |

***
See also:

- [BoolType](BoolType.md)
- [CallableType](CallableType.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [NotBlank](NotBlank.md)
- [NotEmpty](NotEmpty.md)
- [NotUndef](NotUndef.md)
- [NullType](NullType.md)
- [NumericVal](NumericVal.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [Type](Type.md)
