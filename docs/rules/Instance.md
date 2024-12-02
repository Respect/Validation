# Instance

- `Instance(string $instanceName)`

Validates if the input is an instance of the given class or interface.

```php
v::instance('DateTime')->isValid(new DateTime); // true
v::instance('Traversable')->isValid(new ArrayObject); // true
```

Message template for this validator includes `{{instanceName}}`.

## Categorization

- Objects

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Countable](Countable.md)
- [IterableType](IterableType.md)
- [IterableVal](IterableVal.md)
- [ObjectType](ObjectType.md)
- [Type](Type.md)
