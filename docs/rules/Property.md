# Property

- `Property(string $name, Rule $rule)`

Validates a property of an object or array using a defined rule.

```php
$object = new stdClass();
$object->name = "John Doe";
v::property('name', v::stringType())->isValid($object); // true
```

## Deprecation Notice

**Changed in v3.0**: This rule was previously named `Attribute`. The `Attribute` rule has been renamed to `Property` for a more accurate term for object properties.

Additionally, in v3.0, the functionality has been split into three specialized rules:
- [Property](Property.md) - Validates a property that may or may not exist
- [PropertyExists](PropertyExists.md) - Validates a property that must exist
- [PropertyOptional](PropertyOptional.md) - Validates a property that may be undefined

```php
// Old v2.4 syntax (deprecated)
v::attribute('name', v::stringType())->isValid($object);

// New v3.0 syntax
v::property('name', v::stringType())->isValid($object);
```

You can also use `Property` to validate nested objects:

```php
$object = new stdClass();
$object->address = new stdClass();
$object->address->postalCode = '1017 BS';

v::property(
    'address',
    v::property('postalCode', v::postalCode('NL'))
)->isValid($object); // true
```

The name of this validator is automatically set to the property name.

```php
$object = new stdClass();
$object->website = "https://example.com";
v::property('website', v::url())->assert($object); // passes
// throws ValidationException with message: website must be present
v::property('website', v::url())->assert(new stdClass());
// throws ValidationException with message: website must be valid URL
v::property('name', v::uppercase())->assert((object)['name' => 'john']);
```

## Note

This rule will validate public, private, protected, uninitialised, and static properties.

* To only validate if a property exists, use [PropertyExists](PropertyExists.md) instead.
* To validate a property against a given rule only if the property exists, use [PropertyOptional](PropertyOptional.md) instead.

## Templates

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Nesting
- Objects
- Structures

## Changelog

| Version | Description                                                                                                                          |
|--------:|--------------------------------------------------------------------------------------------------------------------------------------|
|   3.0.0 | Renamed from `Attribute` to `Property`, and split by [PropertyExists](PropertyExists.md) and [PropertyOptional](PropertyOptional.md) |
|   0.3.9 | Created                                                                                                                              |

***
See also:

- [Attributes](Attributes.md)
- [Key](Key.md)
- [KeyExists](KeyExists.md)
- [KeyOptional](KeyOptional.md)
- [ObjectType](ObjectType.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
