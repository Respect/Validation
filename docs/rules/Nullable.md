# Nullable (Deprecated)

**Deprecated in v3.0**: This rule has been renamed to [NullOr](NullOr.md).

This rule was used to validate the input using a defined rule when the input is not `null`.

```php
// Old v2.4 syntax (deprecated)
v::nullable(v::email())->isValid(null); // true

// New v3.0 syntax
v::nullOr(v::email())->isValid(null); // true
```

See [NullOr](NullOr.md) for the current implementation.