# Age

!!! warning "Removed in v3.0"
    This rule was removed. Use [DateTimeDiff](./DateTimeDiff.md) instead.
    See [Migration Guide](../11-migration-from-2x.md#removed-rules) for migration path.

## Replacement

```php
// v2.x
v::age(18)

// v3.0
v::dateTimeDiff('years')->equals(18)
```

## Description (v2.x)

Validates age in years based on a reference date (default is now).

## Examples (v2.x)

```php
v::age(18)->isValid('2000-01-01'); // true if person is 18 or older
v::age(18, new DateTime('2020-01-01'))->isValid('2000-01-01'); // true
```

## Changelog

| Version | Description         |
|--------:|---------------------|
|   3.0.0 | Removed             |
|   1.0.0 | Created             |

***
See also:

- [DateTimeDiff](DateTimeDiff.md)
- [MinAge](MinAge.md) (also removed)
- [MaxAge](MaxAge.md) (also removed)