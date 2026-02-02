<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
SPDX-FileContributor: Reginaldo Junior <76regi@gmail.com>
SPDX-FileContributor: Vitaliy <reboot.m@gmail.com>
-->

# FloatType

- `FloatType()`

Validates whether the type of the input is [float](http://php.net/types.float).

```php
v::floatType()->assert(1.5);
// Validation passes successfully

v::floatType()->assert('1.5');
// → "1.5" must be a float

v::floatType()->assert(0e5);
// Validation passes successfully
```

## Templates

### `FloatType::TEMPLATE_STANDARD`

|       Mode | Template                        |
| ---------: | :------------------------------ |
|  `default` | {{subject}} must be a float     |
| `inverted` | {{subject}} must not be a float |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers
- Types

## Changelog

| Version | Description       |
| ------: | :---------------- |
|   3.0.0 | Templates changed |
|   1.0.0 | Created           |

## See Also

- [ArrayType](ArrayType.md)
- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [CallableType](CallableType.md)
- [FloatVal](FloatVal.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [NumericVal](NumericVal.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [StringVal](StringVal.md)
