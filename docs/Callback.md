# Callback

- `Callback(callable $callback)`

Validates the input using the return of a given callable.

```php
v::callback(
    function (int $input): bool {
        return $input + ($input / 2) == 15;
    }
)->validate(10); // true
```

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Call](Call.md)
- [CallableType](CallableType.md)
- [FilterVar](FilterVar.md)
