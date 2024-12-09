# IterableVal

- `IterableVal()`

Validates whether the input is an iterable value, in other words,  if you can iterate over it with the [foreach][] language construct.

```php
v::iterableVal()->isValid([]); // true
v::iterableVal()->isValid(new ArrayObject()); // true
v::iterableVal()->isValid(new stdClass()); // true
v::iterableVal()->isValid('string'); // false
```

## Note

This rule doesn't behave as PHP's [is_iterable() function because it considers that you can iterate over any object.

## Templates

### `IterableVal::TEMPLATE_STANDARD`

| Mode       | Template                               |
|------------|----------------------------------------|
| `default`  | {{name}} must be an iterable value     |
| `inverted` | {{name}} must not be an iterable value |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Types

## Changelog

| Version | Description                                  |
|--------:|----------------------------------------------|
|   3.0.0 | Renamed from `IterableType` to `IterableVal` |
|   1.0.8 | Renamed from `Iterable` to `IterableType`    |
|   1.0.0 | Created as `Iterable`                        |

***
See also:

- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [Countable](Countable.md)
- [Each](Each.md)
- [Instance](Instance.md)
- [IterableType](IterableType.md)

[is_iterable()]: https://www.php.net/is_iterable
[foreach]: http://php.net/foreach
