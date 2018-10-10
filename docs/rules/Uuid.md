# Uuid

- `Uuid(string $version = Uuid::VERSION_ALL)`

Validates whether the type of an input is a valid UUID.  
It's optional possible to test for a specific version.

```php
v::uuid()->validate('Hello World!'); // false
v::uuid()->validate('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // true
v::uuid(Uuid::VERSION_1)->validate('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // false
v::uuid(Uuid::VERSION_4)->validate('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // true
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

  * [Digit](Digit.md)
  * [Base](Base.md)
