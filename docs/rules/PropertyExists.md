# PropertyExists

- `PropertyExists(string $propertyName)`

Validates if an object property exists.

```php
$object = new stdClass;
$object->name = 'The Respect Panda';
$object->email = 'therespectpanda@gmail.com';

v::propertyExists('name')->isValid($object); // true
v::propertyExists('email')->isValid($object); // true
v::propertyExists('website')->isValid($object); // false
```

## Notes

This rule will validate public, private, protected, uninitialised, and static properties.

* To validate a property against a given rule requiring the property to exist, use [Property](Property.md) instead.
* To validate a property against a given rule only if the property exists, use [PropertyOptional](PropertyOptional.md) instead.

## Templates

### `PropertyExists::TEMPLATE_STANDARD`

| Mode       | Template                     |
|------------|------------------------------|
| `default`  | {{name}} must be present     |
| `inverted` | {{name}} must not be present |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Objects
- Structures

## Changelog

| Version | Description                          |
|--------:|--------------------------------------|
|   3.0.0 | Created from [Property](Property.md) |

***
See also:

- [Key](Key.md)
- [KeyExists](KeyExists.md)
- [KeyOptional](KeyOptional.md)
- [ObjectType](ObjectType.md)
- [Property](Property.md)
- [PropertyOptional](PropertyOptional.md)
