# IterableType

- `v::iterableType()`

Validates if the input is iterable, in other words, if you're able to iterate
over it with [foreach](http://php.net/foreach) language construct.

```php
v::iterableType()->validate([]); // true
v::iterableType()->validate(new ArrayObject()); // true
v::iterableType()->validate(new stdClass()); // true
v::iterableType()->validate('string'); // false
```

***
See also:

  * [ArrayType](ArrayType.md)
  * [ArrayVal](ArrayVal.md)
  * [Countable](Countable.md)
  * [Instance](Instance.md)
  * [Iterable](Iterable.md)
