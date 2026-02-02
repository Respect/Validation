<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# KeyOptional

- `KeyOptional(string|int $key, Validator $validator)`

Validates the value of an array against a given validator when the key exists.

```php
v::keyOptional('name', v::stringType())->assert([]);
// Validation passes successfully

v::keyOptional('name', v::stringType())->assert(['name' => 'The Respect Panda']);
// Validation passes successfully

v::keyOptional('email', v::email())->assert([]);
// Validation passes successfully

v::keyOptional('email', v::email())->assert(['email' => 'therespectpanda@gmail.com']);
// Validation passes successfully

v::keyOptional('age', v::intVal())->assert(['age' => 'Twenty-Five']);
// → `.age` must be an integer
```

The name of this validator is automatically set to the key name.

```php
v::keyOptional('age', v::intVal())->assert(['age' => 'Twenty-Five']);
// → `.age` must be an integer
```

## Note

This validator will pass for anything that is not an array because it will always pass when it doesn't find a key. If you
want to ensure the input is an array, use [ArrayType](ArrayType.md) with it.

```php
v::arrayType()->keyOptional('phone', v::phone())->assert('This is not an array');
// → "This is not an array" must be an array
```

Below are some other validators that are tightly related to `KeyOptional`:

- To validate if a key exists, use [KeyExists](KeyExists.md) instead.
- To validate an array against a given validator requiring the key to exist, use [Key](Key.md) instead.

## Templates

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays
- Structures

## Changelog

| Version | Description                |
| ------: | :------------------------- |
|   3.0.0 | Created from [Key](Key.md) |

## See Also

- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [Each](Each.md)
- [Key](Key.md)
- [KeyExists](KeyExists.md)
- [Property](Property.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)

[array]: https://www.php.net/array
[ArrayAccess]: https://www.php.net/arrayaccess
