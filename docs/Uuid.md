# Uuid

- `Uuid()`

Validates whether the type of an input is a valid UUID. Both version 1 and version 4 or supported.

```php
v::uuid()->validate('Hello World!'); // false
v::uuid()->validate('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // true
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

  * [Digit](Digit.md)
  * [Base](Base.md)
