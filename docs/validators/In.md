<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
SPDX-FileContributor: Kirill Dlussky <kirill@dlussky.ru>
-->

# In

- `In(mixed $haystack)`

Validates if the input is contained in a specific haystack.

For strings:

```php
v::in('lorem ipsum')->assert('ipsum');
// Validation passes successfully
```

For arrays:

```php
v::in(['lorem', 'ipsum'])->assert('lorem');
// Validation passes successfully
```

Message template for this validator includes `{{haystack}}`.

## Templates

### `In::TEMPLATE_STANDARD`

|       Mode | Template                                |
| ---------: | :-------------------------------------- |
|  `default` | {{subject}} must be in {{haystack}}     |
| `inverted` | {{subject}} must not be in {{haystack}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `haystack`  |                                                                  |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays
- Comparisons
- Strings

## Changelog

| Version | Description                         |
| ------: | :---------------------------------- |
|   3.0.0 | Case-insensitive comparison removed |
|   0.3.9 | Created                             |

## See Also

- [Contains](Contains.md)
- [ContainsAny](ContainsAny.md)
- [EndsWith](EndsWith.md)
- [Roman](Roman.md)
- [StartsWith](StartsWith.md)
