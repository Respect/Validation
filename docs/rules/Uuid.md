# Uuid

- `Uuid()`
- `Uuid(int $version)`

Validates whether the input is a valid UUID. It also supports validation of
specific versions 1, 3, 4 and 5.

```php
v::uuid()->isValid('Hello World!'); // false
v::uuid()->isValid('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // true
v::uuid(1)->isValid('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // false
v::uuid(4)->isValid('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // true
```

## Categorization

- Strings

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [Base](Base.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
