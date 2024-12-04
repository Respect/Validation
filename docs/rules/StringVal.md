# StringVal

- `StringVal()`

Validates whether the input can be used as a string.

```php
v::stringVal()->isValid('6'); // true
v::stringVal()->isValid('String'); // true
v::stringVal()->isValid(1.0); // true
v::stringVal()->isValid(42); // true
v::stringVal()->isValid(false); // true
v::stringVal()->isValid(true); // true
v::stringVal()->isValid(new ClassWithToString()); // true if ClassWithToString implements `__toString`
```

## Templates

`StringVal::TEMPLATE_STANDARD`

| Mode       | Template                            |
|------------|-------------------------------------|
| `default`  | {{name}} must be a string value     |
| `inverted` | {{name}} must not be a string value |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Strings
- Types

## Changelog

| Version | Description |
|--------:|-------------|
|   2.0.0 | Created     |

***
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
