# Uuid

- `Uuid()`
- `Uuid(int $version)`
- `Uuid(?int $version, ?bool $useRamseyUuid)`

Validates whether the input is a valid UUID. It also supports validation of
specific versions 1, 3, 4 and 5.

```php
v::uuid()->isValid('Hello World!'); // false
v::uuid()->isValid('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // true
v::uuid(1)->isValid('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // false
v::uuid(4)->isValid('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // true
```

Optionally, you are able to use ramsey/uuid library to support validation
of all UUID versions 1 to 8, This will be automatically enabled if ramsey/uuid
is detected but can be manually disabled to revert to the original behavior.

if ramsey/uuid is loaded
```php
v::uuid()->isValid('Hello World!'); // false
v::uuid()->isValid('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // true
v::uuid(1)->isValid('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // false
v::uuid(4)->isValid('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // true
v::uuid(8)->isValid('00112233-4455-8677-8899-aabbccddeeff'); // true
v::uuid(8, false)->isValid('00112233-4455-8677-8899-aabbccddeeff'); // false <-- same UUID as above, but with ramsey/uuid disabled
v::uuid(4)->isValid(new \Ramsey\Uuid\Uuid::fromString('eb3115e5-bd16-4939-ab12-2b95745a30f3')); // true
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
