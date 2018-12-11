# ArrayVal

- `v::arrayVal()`

Validates if the input is an array or if the input can be used as an array
(instance of `ArrayAccess`).

```php
v::arrayVal()->validate([]); // true
v::arrayVal()->validate(new ArrayObject); // true
```

***
See also:

  * [ArrayType](ArrayType.md)
  * [Countable](Countable.md)
  * [Each](Each.md)
  * [IterableType](IterableType.md)
  * [Key](Key.md)
  * [KeySet](KeySet.md)
  * [KeyValue](KeyValue.md)
  * [Type](Type.md)
