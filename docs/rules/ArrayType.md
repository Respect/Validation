# ArrayType

- `ArrayType()`

Validates whether the type of an input is array.

```php
v::arrayType()->isValid([]); // true
v::arrayType()->isValid([1, 2, 3]); // true
v::arrayType()->isValid(new ArrayObject()); // false
```

## Templates

`ArrayType::TEMPLATE_STANDARD`

| Mode       | Template                      |
|------------|-------------------------------|
| `default`  | {{name}} must be an array     |
| `inverted` | {{name}} must not be an array |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays
- Types

## Changelog

| Version | Description |
|--------:|-------------|
|   1.0.0 | Created     |

***
See also:

- [ArrayVal](ArrayVal.md)
- [BoolType](BoolType.md)
- [CallableType](CallableType.md)
- [Countable](Countable.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [IterableType](IterableType.md)
- [IterableVal](IterableVal.md)
- [KeyExists](KeyExists.md)
- [KeyOptional](KeyOptional.md)
- [NullType](NullType.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [Subset](Subset.md)
- [Type](Type.md)
- [Unique](Unique.md)
