# Property

- `Property(string $propertyName, Validator $validator)`

Validates an object property against a given validator.

```php
$object = new stdClass;
$object->name = 'The Respect Panda';
$object->email = 'therespectpanda@gmail.com';

v::property('name', v::equals('The Respect Panda'))->isValid($object); // true

v::property('email', v::email())->isValid($object); // true

v::property('email', v::email()->endsWith('@example.com'))->assert($object); // false
```

You can also use `Property` to validate nested objects:

```php
$object->address = new stdClass();
$object->address->postalCode = '1017 BS';

v::property(
    'address',
    v::property('postalCode', v::postalCode('NL'))
)->isValid($object); // true
```

The name of this validator is automatically set to the property name.

```php
v::property('website', v::url())->assert($object);
// message: website must be present

v::property('name', v::uppercase())->assert($object);
// message: name must be uppercase
```

## Note

This validator will validate public, private, protected, uninitialised, and static properties.

- To only validate if a property exists, use [PropertyExists](PropertyExists.md) instead.
- To validate a property against a given validator only if the property exists, use [PropertyOptional](PropertyOptional.md) instead.

## Templates

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Nesting
- Objects
- Structures

## Changelog

| Version | Description                                                                                                                          |
| ------: | ------------------------------------------------------------------------------------------------------------------------------------ |
|   3.0.0 | Renamed from `Attribute` to `Property`, and split by [PropertyExists](PropertyExists.md) and [PropertyOptional](PropertyOptional.md) |
|   0.3.9 | Created                                                                                                                              |

---

See also:

- [Attributes](Attributes.md)
- [Key](Key.md)
- [KeyExists](KeyExists.md)
- [KeyOptional](KeyOptional.md)
- [ObjectType](ObjectType.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
