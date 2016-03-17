# Iterable

- `v::iterable()`

Validates if the input is iterable, in other words, if you're able to iterate
over it with [foreach](http://php.net/foreach) language construct.

```php
v::iterable()->validate([]); // true
v::iterable()->validate(new ArrayObject()); // true
v::iterable()->validate(new stdClass()); // true
v::iterable()->validate('string'); // false
```

***
See also:

  * [ArrayVal](ArrayVal.md)
  * [Countable](Countable.md)
  * [Instance](Instance.md)
