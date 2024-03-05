# PropertyExists

- `PropertyExists(string $propertyName)`

Validates if an object property exists.

```php
$object = new stdClass;
$object->name = 'The Respect Panda';
$object->email = 'therespectpanda@gmail.com';

v::propertyExists('name')->validate($object); // true
v::propertyExists('email')->validate($object); // true
v::propertyExists('website')->validate($object); // false
```

## Notes

This rule will validate public, private, protected, uninitialised, and static properties.

* To validate a property against a given rule requiring the property to exist, use [Property](Property.md) instead.
* To validate a property against a given rule only if the property exists, use [PropertyOptional](PropertyOptional.md) instead.

## Categorization

- Objects
- Structures

## Changelog

| Version | Description                          |
| ------: |--------------------------------------|
|   3.0.0 | Created from [Property](Property.md) |

***
See also:

- [Key](Key.md)
- [KeyExists](KeyExists.md)
- [KeyOptional](KeyOptional.md)
- [ObjectType](ObjectType.md)
- [Property](Property.md)
- [PropertyOptional](PropertyOptional.md)
