# MaxAge

!!! warning "Removed in v3.0"
    This rule was removed. Use [DateTimeDiff](./DateTimeDiff.md) with [LessThanOrEqual](./LessThanOrEqual.md) instead.
    See [Migration Guide](../11-migration-from-2x.md#removed-rules) for migration path.

## Replacement

```php
// v2.x
v::maxAge(65)

// v3.0
v::dateTimeDiff('years')->lessThanOrEqual(65)
```

## Description (v2.x)

Validates that a date is at most a certain number of years in the past.

## Examples (v2.x)

```php
v::maxAge(65)->isValid('1980-01-01'); // true if person is 65 or younger
v::maxAge(30, new DateTime('2020-01-01'))->isValid('1995-01-01'); // true
```

## Changelog

| Version | Description         |
|--------:|---------------------|
|   3.0.0 | Removed             |
|   1.0.0 | Created             |

***
See also:

- [DateTimeDiff](DateTimeDiff.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Age](Age.md) (also removed)
- [MinAge](MinAge.md) (also removed)