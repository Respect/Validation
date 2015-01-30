# Callback

- `v::callback(callable $callback)`

This is a wildcard validator, it uses a function name, method or closure
to validate something:

```php
v::callback('is_int')->validate(10); //true
```

(Please note that this is a sample, the `v::int()` validator is much better).

As in `v::call()`, you can pass a method or closure to it.

See also:

  * [Call](Call.md)
  * [FilterVar](FilterVar.md)
