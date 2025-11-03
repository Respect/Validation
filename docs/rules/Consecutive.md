# Consecutive

!!! warning "Removed in v3.0"
    This rule was removed. Use [Lazy](./Lazy.md) instead.
    See [Migration Guide](../11-migration-from-2x.md#removed-rules) for migration path.

## Replacement

```php
// v2.x
v::consecutive(v::intVal(), v::positive(), v::lessThan(100))

// v3.0
v::lazy(v::intVal(), v::positive(), v::lessThan(100))
```

## Description (v2.x)

Validates input against multiple rules in sequence, stopping at the first failure.

## Examples (v2.x)

```php
v::consecutive(
    v::intVal(), 
    v::positive(), 
    v::lessThan(100)
)->isValid(50); // true

v::consecutive(
    v::intVal(), 
    v::positive(), 
    v::lessThan(100)
)->isValid(-5); // false (fails at second rule)
```

## Changelog

| Version | Description         |
|--------:|---------------------|
|   3.0.0 | Removed             |
|   1.0.0 | Created             |

***
See also:

- [Lazy](Lazy.md)
- [KeyValue](KeyValue.md) (also removed)