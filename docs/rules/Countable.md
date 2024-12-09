# Countable

- `Countable()`

Validates if the input is countable, in other words, if you're allowed to use
[count()](http://php.net/count) function on it.

```php
v::countable()->isValid([]); // true
v::countable()->isValid(new ArrayObject()); // true
v::countable()->isValid('string'); // false
```

## Templates

### `Countable::TEMPLATE_STANDARD`

| Mode       | Template                               |
|------------|----------------------------------------|
| `default`  | {{name}} must be a countable value     |
| `inverted` | {{name}} must not be a countable value |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Types

## Changelog

| Version | Description             |
|--------:|-------------------------|
|   1.0.0 | Created from `ArrayVal` |

***
See also:

- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [Instance](Instance.md)
- [IterableType](IterableType.md)
- [IterableVal](IterableVal.md)
