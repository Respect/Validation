# ArrayVal

- `ArrayVal()`

Validates if the input is an array or if the input can be used as an array
(instance of `ArrayAccess` or `SimpleXMLElement`).

```php
v::arrayVal()->isValid([]); // true
v::arrayVal()->isValid(new ArrayObject); // true
v::arrayVal()->isValid(new SimpleXMLElement('<xml></xml>')); // true
```

## Categorization

- Arrays
- Types

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
- [IterableVal](IterableVal.md)
- [Key](Key.md)
- [KeyExists](KeyExists.md)
- [KeyOptional](KeyOptional.md)
- [KeySet](KeySet.md)
- [ScalarVal](ScalarVal.md)
- [Sorted](Sorted.md)
- [Subset](Subset.md)
- [Type](Type.md)
- [Unique](Unique.md)
