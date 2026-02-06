<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Templated

- `Templated(string $template, Validator $validator)`
- `Templated(string $template, Validator $validator, array<string, mixed> $parameters)`

Defines a validator with a custom message template.

```php
v::templated('You must provide a valid email', v::email())->assert('foo@bar.com');
// Validation passes successfully

v::templated('You must provide a valid email', v::email())->assert('not an email');
// → You must provide a valid email

v::templated(
    'The author of the page {{title}} is empty, please fill it up.',
    v::notBlank(),
    ['title' => 'Feature Guide']
)->assert('');
// → The author of the page "Feature Guide" is empty, please fill it up.
```

This validator can be also useful when you're using [Attributes](Attributes.md) and want a custom template for a specific property.

## Templates

This validator does not have any templates, as you must define the templates yourself.

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Core
- Display
- Miscellaneous

## Changelog

| Version | Description |
| ------: | :---------- |
|   3.0.0 | Created     |

## See Also

- [Attributes](Attributes.md)
- [Named](Named.md)
- [Not](Not.md)
