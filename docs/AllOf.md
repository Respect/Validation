# AllOf

- `AllOf(Rule ...$rule)`

Will validate if all inner validators validates.

```php
v::allOf(
    v::intVal(),
    v::positive()
)->isValid(15); // true
```

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [AnyOf](AnyOf.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
- [When](When.md)
