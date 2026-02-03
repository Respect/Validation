<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# BoolVal

- `BoolVal()`

Validates if the input results in a boolean value:

```php
v::boolVal()->assert('on');
// Validation passes successfully

v::boolVal()->assert('off');
// Validation passes successfully

v::boolVal()->assert('yes');
// Validation passes successfully

v::boolVal()->assert('no');
// Validation passes successfully

v::boolVal()->assert(1);
// Validation passes successfully

v::boolVal()->assert(0);
// Validation passes successfully
```

## Templates

### `BoolVal::TEMPLATE_STANDARD`

|       Mode | Template                                |
| ---------: | :-------------------------------------- |
|  `default` | {{subject}} must be a boolean value     |
| `inverted` | {{subject}} must not be a boolean value |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Booleans
- Types

## Changelog

| Version | Description |
| ------: | :---------- |
|   1.0.0 | Created     |

## See Also

- [BoolType](BoolType.md)
- [CallableType](CallableType.md)
- [FloatType](FloatType.md)
- [FloatVal](FloatVal.md)
- [IntType](IntType.md)
- [NullType](NullType.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [TrueVal](TrueVal.md)
