# Attribute (Deprecated)

**Deprecated in v3.0**: This rule has been renamed to [Property](Property.md).

This rule was used to validate a specific attribute of an object or array.

```php
// Old v2.4 syntax (deprecated)
v::attribute('name', v::stringType())->isValid($object);

// New v3.0 syntax
v::property('name', v::stringType())->isValid($object);
```

In v3.0, the functionality has been split into three specialized rules:
- [Property](Property.md) - Validates a property that may or may not exist
- [PropertyExists](PropertyExists.md) - Validates a property that must exist
- [PropertyOptional](PropertyOptional.md) - Validates a property that may be undefined

See [Property](Property.md) for the current implementation.