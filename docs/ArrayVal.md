# ArrayVal

- `ArrayVal()`

Validates if the input is an array or if the input can be used as an array
(instance of `ArrayAccess` or `SimpleXMLElement`).

```php
v::arrayVal()->validate([]); // true
v::arrayVal()->validate(new ArrayObject); // true
v::arrayVal()->validate(new SimpleXMLElement($xml)); // true
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | `SimpleXMLElement` is also considered as valid
  1.0.0 | Renamed from `Arr` to `ArrayVal` and validate only if the input can be used as an array (#1)
  0.3.9 | Created as `Arr`

1. Previously this rule considered `Traversable` and `Countable` as valid inputs.

***
See also:

- [ArrayType](ArrayType.md)
- [Countable](Countable.md)
- [Each](Each.md)
- [IterableType](IterableType.md)
- [Key](Key.md)
- [KeySet](KeySet.md)
- [KeyValue](KeyValue.md)
