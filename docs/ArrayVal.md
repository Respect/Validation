# ArrayVal

- `ArrayVal()`

Validates if the input is an array or if the input can be used as an array
(instance of `ArrayAccess` or `SimpleXMLElement`).

```php
v::arrayVal()->validate([]); // true
v::arrayVal()->validate(new ArrayObject); // true
v::arrayVal()->validate(new SimpleXMLElement($xml)); // true
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
