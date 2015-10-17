# ArrayType

- `v::arrayType()`

Validates whether the type of an input is array.

```php
v::arrayType()->validate([]); // true
v::arrayType()->validate([1, 2, 3]); // true
v::arrayType()->validate(new ArrayObject()); // false
```

***
See also:

  * [ArrayVal](ArrayVal.md)
  * [Countable](Countable.md)
  * [Iterable](Iterable.md)
  * [Iterable](Iterable.md)
