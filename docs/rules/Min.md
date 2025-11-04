# Min (Deprecated)

**Deprecated in v3.0**: This rule has been renamed to [GreaterThanOrEqual](GreaterThanOrEqual.md).

This rule was used to validate the minimum value of the input against a given rule.

```php
// Old v2.4 syntax (deprecated)
v::min(v::equals(10))->isValid([10, 20, 30]); // true

// New v3.0 syntax
v::greaterThanOrEqual(10)->isValid([10, 20, 30]); // true
```

See [GreaterThanOrEqual](GreaterThanOrEqual.md) for the current implementation.
