<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
SPDX-FileContributor: Reginaldo Junior <76regi@gmail.com>
-->

# FloatVal

- `FloatVal()`

Validate whether the input value is float.

```php
v::floatVal()->assert(1.5);
// Validation passes successfully

v::floatVal()->assert('1e5');
// Validation passes successfully
```

## Templates

### `FloatVal::TEMPLATE_STANDARD`

|       Mode | Template                              |
| ---------: | :------------------------------------ |
|  `default` | {{subject}} must be a float value     |
| `inverted` | {{subject}} must not be a float value |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers
- Types

## Changelog

| Version | Description |
| ------: | :---------- |
|   1.0.0 | Created     |

## See Also

- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [FloatType](FloatType.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
