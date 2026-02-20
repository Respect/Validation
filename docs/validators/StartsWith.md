<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# StartsWith

- `StartsWith(mixed $startValue)`
- `StartsWith(mixed $startValue, mixed ...$startValues)`

Validates whether the input starts with one of the given values.

This validator is similar to [Contains](Contains.md), but validates only
if the value is at the beginning of the input.

For strings:

```php
v::startsWith('lorem')->assert('lorem ipsum');
// Validation passes successfully

v::startsWith('Dr.', 'Mr.')->assert('Dr. Jane Doe');
// Validation passes successfully
```

For arrays:

```php
v::startsWith('lorem')->assert(['lorem', 'ipsum']);
// Validation passes successfully

v::startsWith(0, 1)->assert([0, 1, 2, 3]);
// Validation passes successfully

v::startsWith(0, 1)->assert([1, 2, 3]);
// Validation passes successfully
```

Message template for this validator includes `{{startValue}}` and `{{startValues}}`.

## Templates

### `StartsWith::TEMPLATE_STANDARD`

|       Mode | Template                                       |
| ---------: | :--------------------------------------------- |
|  `default` | {{subject}} must start with {{startValue}}     |
| `inverted` | {{subject}} must not start with {{startValue}} |

### `StartsWith::TEMPLATE_MULTIPLE_VALUES`

|       Mode | Template                                                     |
| ---------: | :----------------------------------------------------------- |
|  `default` | {{subject}} must start with {{startValues&#124;list:or}}     |
| `inverted` | {{subject}} must not start with {{startValues&#124;list:or}} |

## Template placeholders

| Placeholder   | Description                                                      |
| ------------- | ---------------------------------------------------------------- |
| `subject`     | The validated input or the custom validator name (if specified). |
| `startValue`  | The value that will be checked to be at the start of the input.  |
| `startValues` | Additional values to check.                                      |

## Categorization

- Arrays
- Strings

## Changelog

| Version | Description                         |
| ------: | :---------------------------------- |
|   3.1.0 | Added support for multiple values   |
|   3.0.0 | Case-insensitive comparison removed |
|   0.3.9 | Created                             |

## See Also

- [Contains](Contains.md)
- [EndsWith](EndsWith.md)
- [In](In.md)
- [Regex](Regex.md)
- [Trimmed](Trimmed.md)
