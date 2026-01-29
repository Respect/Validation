<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# ContainsAny

- `ContainsAny(non-empty-array<mixed> $needles)`

Validates if the input contains at least one of defined values

For strings:

```php
v::containsAny(['lorem', 'dolor'])->assert('lorem ipsum');
// Validation passes successfully
```

For arrays:

```php
v::containsAny(['lorem', 'dolor'])->assert(['ipsum', 'lorem']);
// Validation passes successfully
```

Message template for this validator includes `{{needles}}`.

## Templates

### `ContainsAny::TEMPLATE_STANDARD`

|       Mode | Template                                                     |
| ---------: | :----------------------------------------------------------- |
|  `default` | {{subject}} must contain at least one value from {{needles}} |
| `inverted` | {{subject}} must not contain any value from {{needles}}      |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |
| `needles`   |                                                                  |

## Categorization

- Arrays
- Strings

## Changelog

| Version | Description                         |
| ------: | :---------------------------------- |
|   3.0.0 | Case-insensitive comparison removed |
|   2.0.0 | Created                             |

## See Also

- [AnyOf](AnyOf.md)
- [Contains](Contains.md)
- [ContainsCount](ContainsCount.md)
- [Equivalent](Equivalent.md)
- [In](In.md)
