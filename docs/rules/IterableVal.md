# IterableVal

- `IterableVal()`

Validates whether the input is an iterable value, in other words,  if you can iterate over it with the [foreach][] language construct.

```php
use Respect\Validation\Validator as v;

v::iterableVal()->validate([]); // true
v::iterableVal()->validate(new ArrayObject()); // true
v::iterableVal()->validate(new stdClass()); // true
v::iterableVal()->validate('string'); // false
```

## Note

This rule doesn't behave as PHP's [is_iterable() function because it considers that you can iterate over any object.

## Categorization

- Types

## Changelog

|  Version | Description                                  |
|---------:|----------------------------------------------|
|    3.0.0 | Renamed from `IterableType` to `IterableVal` |
|    1.0.8 | Renamed from `Iterable` to `IterableType`    |
|    1.0.0 | Created as `Iterable`                        |

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
