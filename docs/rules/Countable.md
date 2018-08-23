# Countable

- `Countable()`

Validates if the input is countable, in other words, if you're allowed to use
[count()](http://php.net/count) function on it.

```php
v::countable()->validate([]); // true
v::countable()->validate(new ArrayObject()); // true
v::countable()->validate('string'); // false
```

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created from `ArrayVal`

***
See also:

- [ArrayVal](ArrayVal.md)
- [Instance](Instance.md)
- [IterableType](IterableType.md)
