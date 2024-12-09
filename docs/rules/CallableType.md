# CallableType

- `CallableType()`

Validates whether the pseudo-type of the input is [callable](http://php.net/types.callable).

```php
v::callableType()->isValid(function () {}); // true
v::callableType()->isValid('trim'); // true
v::callableType()->isValid([new DateTime(), 'format']); // true
```

## Templates

### `CallableType::TEMPLATE_STANDARD`

| Mode       | Template                        |
|------------|---------------------------------|
| `default`  | {{name}} must be a callable     |
| `inverted` | {{name}} must not be a callable |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Callables
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
- [Callback](Callback.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [Lazy](Lazy.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
- [Type](Type.md)
