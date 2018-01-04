# IterableType

- `IterableType()`

Validates if the input is iterable, in other words, if you're able to iterate
over it with [foreach](http://php.net/foreach) language construct.

```php
v::iterableType()->isValid([]); // true
v::iterableType()->isValid(new ArrayObject()); // true
v::iterableType()->isValid(new stdClass()); // true
v::iterableType()->isValid('string'); // false
```

## Changelog

Version | Description
--------|-------------
  1.0.8 | Renamed from `Iterable` to `IterableType`
  1.0.0 | Created as `Iterable`

***
See also:

- [ArrayVal](ArrayVal.md)
- [Countable](Countable.md)
- [Instance](Instance.md)
