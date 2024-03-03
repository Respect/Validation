# Property

- `Property(string $propertyName, Validatable $rule)`

Validates an object property against a given rule.

```php
$object = new stdClass;
$object->name = 'The Respect Panda';
$object->email = 'therespectpanda@gmail.com';

v::property('name', v::equals('The Respect Panda'))->validate($object); // true

v::property('email', v::email())->validate($object); // true

v::property('email', v::email()->endsWith('@example.com'))->assert($object); // false
```

The name of this validator is automatically set to the property name.

```php
v::property('website', v::url())->assert($object);
// message: website must be present

v::property('name', v::uppercase())->assert($object);
// message: name must be uppercase
```

## Note

This rule will validate public, private, protected, uninitialised, and static properties.

* To only validate if a property exists, use [PropertyExists](PropertyExists.md) instead.
* To validate a property against a given rule only if the property exists, use [PropertyOptional](PropertyOptional.md) instead.

## Categorization

- Nesting
- Objects
- Structures

## Changelog

| Version | Description                                                                                                                          |
| ------: |--------------------------------------------------------------------------------------------------------------------------------------|
|   3.0.0 | Renamed from `Attribute` to `Property`, and split by [PropertyExists](PropertyExists.md) and [PropertyOptional](PropertyOptional.md) |
|   0.3.9 | Created                                                                                                                              |

***
See also:

- [Key](Key.md)
- [KeyExists](KeyExists.md)
- [KeyNested](KeyNested.md)
- [KeyOptional](KeyOptional.md)
- [ObjectType](ObjectType.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
