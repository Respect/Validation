# IterableType

- `IterableType()`

Validates whether the pseudo-type of the input is iterable or not, in other words,
if you're able to iterate over it with [foreach](http://php.net/foreach) language
construct.

```php
v::iterableType()->validate([]); // true
v::iterableType()->validate(new ArrayObject()); // true
v::iterableType()->validate(new stdClass()); // true
v::iterableType()->validate('string'); // false
```

## Categorization

- Types

## Changelog

Version | Description
--------|-------------
  1.0.8 | Renamed from `Iterable` to `IterableType`
  1.0.0 | Created as `Iterable`

***
See also:

- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [Countable](Countable.md)
- [Each](Each.md)
- [Instance](Instance.md)
