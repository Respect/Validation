# MinAge

!!! warning "Removed in v3.0"
    This rule was removed. Use [DateTimeDiff](./DateTimeDiff.md) with [GreaterThanOrEqual](./GreaterThanOrEqual.md) instead.
    See [Migration Guide](../11-migration-from-2x.md#removed-rules) for migration path.

## Replacement

```php
// v2.x
v::minAge(18)

// v3.0
v::dateTimeDiff('years')->greaterThanOrEqual(18)
```

## Description (v2.x)

Validates that a date is at least a certain number of years in the past.

## Examples (v2.x)

```php
v::minAge(18)->isValid('2000-01-01'); // true if person is 18 or older
v::minAge(21, new DateTime('2020-01-01'))->isValid('1990-01-01'); // true
```

## Changelog

| Version | Description         |
|--------:|---------------------|
|   3.0.0 | Removed             |
|   1.0.0 | Created             |

***
See also:

- [DateTimeDiff](DateTimeDiff.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [Age](Age.md) (also removed)
- [MaxAge](MaxAge.md) (also removed)