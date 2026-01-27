<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Named

- `Named(Name|string $name, Validator $validator)`

Validates the input with the given validator, and uses the custom name in the error message.

```php
v::named('Your email', v::email())->assert('foo@example.com');
// Validation passes successfully

v::named('Your email', v::email())->assert('not an email');
// → Your email must be a valid email address
```

Here's an example of a similar code, but without using the `Named` validator:

```php
v::email()->assert('not an email');
// → "not an email" must be a valid email address
```

The `Named` validator can be also useful when you're using [Attributes](Attributes.md) and want a custom name for a specific property.

## Templates

This validator does not have any templates, as it will use the template of the given validator.

## Template placeholders

| Placeholder | Description                           |
| ----------- | ------------------------------------- |
| `subject`   | The value that you define as `$name`. |

## Categorization

- Core
- Structures
- Miscellaneous

## Changelog

| Version | Description |
| ------: | :---------- |
|   3.0.0 | Created     |

## See Also

- [Attributes](Attributes.md)
- [Not](Not.md)
- [Templated](Templated.md)
