# ResourceType

- `ResourceType()`

Validates whether the input is a [resource](http://php.net/types.resource).

```php
v::resourceType()->isValid(fopen('/path/to/file.txt', 'w')); // true
```

## Templates

`ResourceType::TEMPLATE_STANDARD`

| Mode       | Template                        |
|------------|---------------------------------|
| `default`  | {{name}} must be a resource     |
| `inverted` | {{name}} must not be a resource |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

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
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [ObjectType](ObjectType.md)
- [PhpLabel](PhpLabel.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
- [Type](Type.md)
