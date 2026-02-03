<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# KeyExists

- `KeyExists(string|int $key)`

Validates if the given key exists in an array.

```php
v::keyExists('name')->assert(['name' => 'The Respect Panda']);
// Validation passes successfully

v::keyExists('name')->assert(['email' => 'therespectpanda@gmail.com']);
// → `.name` must be present

v::keyExists(0)->assert(['a', 'b', 'c']);
// Validation passes successfully

v::keyExists(4)->assert(['a', 'b', 'c']);
// → `.4` must be present

v::keyExists('username')->assert(new ArrayObject(['username' => 'therespectpanda']));
// Validation passes successfully

v::keyExists(5)->assert(new ArrayObject(['a', 'b', 'c']));
// → `.5` must be present
```

## Notes

- To validate an array against a given validator if the key exists, use [KeyOptional](KeyOptional.md) instead.
- To validate an array against a given validator requiring the key to exist, use [Key](Key.md) instead.

## Templates

### `KeyExists::TEMPLATE_STANDARD`

|       Mode | Template                        |
| ---------: | :------------------------------ |
|  `default` | {{subject}} must be present     |
| `inverted` | {{subject}} must not be present |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Caveats

`KeyExists` defines the given `$key` as the path, and because it is a standalone validator without children, it's not possible to display a fully custom name with it.

When no custom name is set, the path is displayed as `{{name}}`. When a custom name is set, the validation engine prepends the path to the custom name:

```php
v::keyExists('foo')->assert([]);
// → `.foo` must be present

v::named('Custom name', v::keyExists('foo'))->assert([]);
// → `.foo` (<- Custom name) must be present
```

If you want to display only a custom name while checking if a key exists, use [Key](Key.md) with [AlwaysValid](AlwaysValid.md):

```php
v::key('foo', v::named('Custom name', v::alwaysValid()))->assert([]);
// → Custom name must be present
```

## Categorization

- Arrays
- Structures

## Changelog

| Version | Description                |
| ------: | :------------------------- |
|   3.0.0 | Created from [Key](Key.md) |

## See Also

- [AlwaysValid](AlwaysValid.md)
- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [Each](Each.md)
- [Key](Key.md)
- [KeyOptional](KeyOptional.md)
- [Property](Property.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
