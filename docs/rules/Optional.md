# Optional (Deprecated)

**Deprecated in v3.0**: This rule has been renamed to [UndefOr](UndefOr.md).

This rule was used to validate the input using a defined rule when the input is not `null` or an empty string (`''`).

```php
// Old v2.4 syntax (deprecated)
v::optional(v::alpha())->isValid(''); // true

// New v3.0 syntax
v::undefOr(v::alpha())->isValid(''); // true
```

See [UndefOr](UndefOr.md) for the current implementation.