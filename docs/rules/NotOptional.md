# NotOptional (Deprecated)

**Deprecated in v3.0**: This rule has been renamed to [NotUndef](NotUndef.md).

This rule was used to validate that the input is not undefined (not null or empty string).

```php
// Old v2.4 syntax (deprecated)
v::notOptional()->isValid('value'); // true

// New v3.0 syntax
v::notUndef()->isValid('value'); // true
```

See [NotUndef](NotUndef.md) for the current implementation.