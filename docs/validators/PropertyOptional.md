<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# PropertyOptional

- `PropertyOptional(string $propertyName, Validator $validator)`

Validates an object property against a given validator only if the property exists.

```php
$object = new stdClass;
$object->name = 'The Respect Panda';
$object->email = 'therespectpanda@gmail.com';

v::propertyOptional('name', v::notBlank())->assert($object);
// Validation passes successfully

v::propertyOptional('email', v::email())->assert($object);
// Validation passes successfully

v::propertyOptional('age', v::intVal())->assert($object);
// Validation passes successfully

v::propertyOptional('website', v::url())->assert($object);
// Validation passes successfully

v::propertyOptional('name', v::lowercase())->assert($object);
// → `.name` must contain only lowercase letters
```

The name of this validator is automatically set to the property name.

```php
v::propertyOptional('email', v::endsWith('@example.com'))->assert($object);
// → `.email` must end with "@example.com"
```

## Note

This validator will validate public, private, protected, uninitialised, and static properties. However, it will pass for
anything that is not an object because it will always pass when it doesn't find a property in the input. If you want to
ensure the input is an object, use [ObjectType](ObjectType.md) with it.

```php
v::propertyOptional('name', v::notBlank())->assert('Not an object');
// Validation passes successfully

v::objectType()->propertyOptional('name', v::notBlank())->assert('Not an object');
// → "Not an object" must be an object
```

- To only validate if a property exists, use [PropertyExists](PropertyExists.md) instead.
- To validate a property against a given validator requiring the property to exist, use [Property](Property.md) instead.

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

| Version | Description                          |
| ------: | :----------------------------------- |
|   3.0.0 | Created from [Property](Property.md) |

## See Also

- [Attributes](Attributes.md)
- [Key](Key.md)
- [KeyExists](KeyExists.md)
- [KeyOptional](KeyOptional.md)
- [ObjectType](ObjectType.md)
- [Property](Property.md)
- [PropertyExists](PropertyExists.md)
