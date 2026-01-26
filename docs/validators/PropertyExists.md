<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# PropertyExists

- `PropertyExists(string $propertyName)`

Validates if an object property exists.

```php
$object = new stdClass;
$object->name = 'The Respect Panda';
$object->email = 'therespectpanda@gmail.com';

v::propertyExists('name')->assert($object);
// Validation passes successfully

v::propertyExists('email')->assert($object);
// Validation passes successfully

v::propertyExists('website')->assert($object);
// → `.website` must be present
```

## Notes

This validator will validate public, private, protected, uninitialised, and static properties.

- To validate a property against a given validator requiring the property to exist, use [Property](Property.md) instead.
- To validate a property against a given validator only if the property exists, use [PropertyOptional](PropertyOptional.md) instead.

## Templates

### `PropertyExists::TEMPLATE_STANDARD`

|       Mode | Template                        |
| ---------: | :------------------------------ |
|  `default` | {{subject}} must be present     |
| `inverted` | {{subject}} must not be present |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Caveats

`PropertyExists` defines the given `$propertyName` as the path, and because it is a standalone validator without children, it's not possible to display a fully custom name with it.

When no custom name is set, the path is displayed as `{{name}}`. When a custom name is set, the validation engine prepends the path to the custom name:

```php
v::propertyExists('foo')->assert([]);
// → `.foo` must be present

v::named('Custom name', v::propertyExists('foo'))->assert([]);
// → `.foo` (<- Custom name) must be present
```

If you want to display only a custom name while checking if a property exists, use [Property](Property.md) with [AlwaysValid](AlwaysValid.md):

```php
v::property('foo', v::named('Custom name', v::alwaysValid()))->assert([]);
// → Custom name must be present
```

## Categorization

- Objects
- Structures

## Changelog

| Version | Description                          |
| ------: | :----------------------------------- |
|   3.0.0 | Created from [Property](Property.md) |

## See Also

- [AlwaysValid](AlwaysValid.md)
- [Attributes](Attributes.md)
- [Key](Key.md)
- [KeyExists](KeyExists.md)
- [KeyOptional](KeyOptional.md)
- [ObjectType](ObjectType.md)
- [Property](Property.md)
- [PropertyOptional](PropertyOptional.md)
