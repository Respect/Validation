# Instance

- `Instance(string $instanceName)`

Validates if the input is an instance of the given class or interface.

```php
v::instance('DateTime')->isValid(new DateTime); // true
v::instance('Traversable')->isValid(new ArrayObject); // true
```

Message template for this validator includes `{{instanceName}}`.

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [ObjectType](ObjectType.md)
