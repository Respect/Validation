# Max (Deprecated)

**Deprecated in v3.0**: This rule has been renamed to [LessThanOrEqual](LessThanOrEqual.md).

This rule was used to validate the maximum value of the input against a given rule.

```php
// Old v2.4 syntax (deprecated)
v::max(v::equals(30))->isValid([10, 20, 30]); // true

// New v3.0 syntax
v::lessThanOrEqual(30)->isValid([10, 20, 30]); // true
```

See [LessThanOrEqual](LessThanOrEqual.md) for the current implementation.
