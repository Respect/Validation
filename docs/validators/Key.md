<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Key

- `Key(string|int $key, Validator $validator)`

Validates the value of an array against a given validator.

```php
v::key('name', v::stringType())->assert(['name' => 'The Respect Panda']);
// Validation passes successfully

v::key('email', v::email())->assert(['email' => 'therespectpanda@gmail.com']);
// Validation passes successfully

v::key('age', v::intVal())->assert([]);
// → `.age` must be present
```

You can also use `Key` to validate nested arrays:

```php
v::key(
    'payment_details',
    v::key('credit_card', v::creditCard())
)->assert([
    'payment_details' => [
        'credit_card' => '5376 7473 9720 8720',
    ],
]);
// Validation passes successfully
```

The name of this validator is automatically set to the key name.

```php
v::key('email', v::email())->assert([]);
// → `.email` must be present

v::key('email', v::email())->assert(['email' => 'not email']);
// → `.email` must be a valid email address
```

## Note

- To validate if a key exists, use [KeyExists](KeyExists.md) instead.
- To validate an array against a given validator if the key exists, use [KeyOptional](KeyOptional.md) instead.

## Templates

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays
- Nesting
- Structures

## Changelog

| Version | Description                                                          |
| ------: | :------------------------------------------------------------------- |
|   3.0.0 | Split by [KeyExists](KeyExists.md) and [KeyOptional](KeyOptional.md) |
|   0.3.9 | Created                                                              |

## See Also

- [ArrayVal](ArrayVal.md)
- [Each](Each.md)
- [KeyExists](KeyExists.md)
- [KeyOptional](KeyOptional.md)
- [KeySet](KeySet.md)
- [Property](Property.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
