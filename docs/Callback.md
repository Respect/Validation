# Callback

- `Callback(callable $callback)`

This is a wildcard validator, it uses a function name, method or closure
to validate something:

```php
v::callback('is_int')->validate(10); // true
```

(Please note that this is a sample, the `IntVal()` validator is much better).

As in `Call()`, you can pass a method or closure to it.

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Call](Call.md)
- [CallableType](CallableType.md)
- [FilterVar](FilterVar.md)
