# PropertyOptional

- `PropertyOptional(string $propertyName, Validatable $rule)`

Validates an object property against a given rule only if the property exists.

```php
$object = new stdClass;
$object->name = 'The Respect Panda';
$object->email = 'therespectpanda@gmail.com';

v::propertyOptional('name', v::notEmpty())->validate($object); // true
v::propertyOptional('email', v::email())->validate($object); // true

v::propertyOptional('age', v::intVal())->validate($object); // true
v::propertyOptional('website', v::url())->validate($object); // true

v::propertyOptional('name', v::lowercase())->validate($object); // false
```

The name of this validator is automatically set to the property name.

```php
v::propertyOptional('email', v::endsWith('@example.com'))->assert($object);
// message: email must end with "@example.com"
```

## Note

This rule will validate public, private, protected, uninitialised, and static properties. However, it will pass for
anything that is not an object because it will always pass when it doesn't find a property in the input. If you want to
ensure the input is an object, use [ObjectType](ObjectType.md) with it.

```php
v::propertyOptional('name', v::notEmpty())->validate('Not an object'); // true
v::objectType()->propertyOptional('name', v::notEmpty())->validate('Not an object'); // false
```

* To only validate if a property exists, use [PropertyExists](PropertyExists.md) instead.
* To validate a property against a given rule requiring the property to exist, use [Property](Property.md) instead.

## Categorization

- Nesting
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
- [PropertyExists](PropertyExists.md)
