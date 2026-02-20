<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# EndsWith

- `EndsWith(mixed $endValue)`
- `EndsWith(mixed $endValue, mixed ...$endValues)`

This validator is similar to `Contains()`, but validates
only if one of the values is at the end of the input. Only
string inputs and string end values are checked; non‑string
values are considered invalid but will not produce PHP errors
thanks to internal type guards.

For strings (non-string inputs are always rejected):

```php
v::endsWith('ipsum')->assert('lorem ipsum');
// Validation passes successfully

v::endsWith(', PhD', ', doctor')->assert('Jane Doe, PhD');
// Validation passes successfully
```

For arrays:

```php
v::endsWith('ipsum')->assert(['lorem', 'ipsum']);
// Validation passes successfully

v::endsWith('.', ';')->assert(['this', 'is', 'a', 'tokenized', 'phrase', '.']);
// Validation passes successfully

v::endsWith('.', ';')->assert(['this', 'is', 'a', 'tokenized', 'phrase']);
// → `["this", "is", "a", "tokenized", "phrase"]` must end with "." or ";"
```

Message template for this validator includes `{{endValue}}` and `{{endValues}}`.

## Templates

### `EndsWith::TEMPLATE_STANDARD`

|       Mode | Template                                   |
| ---------: | :----------------------------------------- |
|  `default` | {{subject}} must end with {{endValue}}     |
| `inverted` | {{subject}} must not end with {{endValue}} |

### `EndsWith::TEMPLATE_MULTIPLE_VALUES`

|       Mode | Template                                                 |
| ---------: | :------------------------------------------------------- |
|  `default` | {{subject}} must end with {{endValues&#124;list:or}}     |
| `inverted` | {{subject}} must not end with {{endValues&#124;list:or}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |
| `endValue`  | The value that will be checked to be at the end of the input.    |
| `endValues` | Additional values to check.                                      |

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
- [In](In.md)
- [Regex](Regex.md)
- [StartsWith](StartsWith.md)
- [Trimmed](Trimmed.md)
