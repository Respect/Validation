# Instance

- `v::instance(string $instanceName)`

Validates if the input is an instance of the given class or interface.

```php
v::instance('DateTime')->validate(new DateTime); // true
v::instance('Traversable')->validate(new ArrayObject); // true
```

Message template for this validator includes `{{instanceName}}`.

***
See also:

  * [Countable](Countable.md)
  * [IterableType](IterableType.md)
  * [ObjectType](ObjectType.md)
  * [Type](Type.md)
