<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Property

- `Property(string $propertyName, Validator $validator)`

Validates an object property against a given validator.

```php
$object = new stdClass;
$object->name = 'The Respect Panda';
$object->email = 'therespectpanda@gmail.com';

v::property('name', v::equals('The Respect Panda'))->assert($object);
// Validation passes successfully

v::property('email', v::email())->assert($object);
// Validation passes successfully

v::property('email', v::email()->endsWith('@example.com'))->assert($object);
// → `.email` must end with "@example.com"
```

You can also use `Property` to validate nested objects:

```php
$object = new stdClass();
$object->address = new stdClass();
$object->address->postalCode = '1017 BS';

v::property(
    'address',
    v::property('postalCode', v::postalCode('BR'))
)->assert($object);
// → `.address.postalCode` must be a valid postal code on "BR"
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
| ------: | :----------------------------------------------------------------------------------------------------------------------------------- |
|   3.0.0 | Renamed from `Attribute` to `Property`, and split by [PropertyExists](PropertyExists.md) and [PropertyOptional](PropertyOptional.md) |
|   0.3.9 | Created                                                                                                                              |

## See Also

- [Attributes](Attributes.md)
- [Key](Key.md)
- [KeyExists](KeyExists.md)
- [KeyOptional](KeyOptional.md)
- [ObjectType](ObjectType.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
