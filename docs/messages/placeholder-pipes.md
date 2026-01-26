<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Placeholder Pipes

Validation uses [StringFormatter](https://github.com/Respect/StringFormatter) to render validation messages. Placeholder pipes allow you to customize how values are rendered by adding a pipe (`|`) followed by a modifier name to your placeholder.

## Usage

To use a placeholder pipe, modify your placeholder like this: `{{placeholder|modifier}}`

```php
v::templated(
    'The {{field|raw}} field is required',
    v::notEmpty(),
    ['field' => 'email'],
)->assert('');
// → The email field is required
// (instead of: The "email" field is required)
```

## Available Modifiers

Validation supports all modifiers from StringFormatter except `StringPassthroughModifier`. For detailed documentation on each modifier, see the [StringFormatter Modifiers documentation](https://github.com/Respect/StringFormatter/blob/main/docs/modifiers/Modifiers.md).

## Examples

```php
// Using with assert()
v::email()->assert($input, 'The {{field|raw}} must be valid', ['field' => 'email']);

// Using with Templated validator
v::templated(
    'The {{field|raw}} must be valid',
    v::email(),
    ['field' => 'email']
)->assert($input);

// Using list modifiers
v::templated(
    'Status must be {{haystack|list:or}}',
    v::in(['active', 'pending', 'archived']),
)->assert('deleted');
// → Status must be "active", "pending", or "archived"
```
