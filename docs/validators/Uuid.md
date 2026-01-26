<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Uuid

- `Uuid()`
- `Uuid(int $version)`

Validates whether the input is a valid UUID. It also supports validation of
specific versions 1 to 8.

```php
v::uuid()->assert('Hello World!');
// → "Hello World!" must be a valid UUID

v::uuid()->assert('eb3115e5-bd16-4939-ab12-2b95745a30f3');
// Validation passes successfully

v::uuid()->assert('eb3115e5bd164939ab122b95745a30f3');
// Validation passes successfully

v::uuid(1)->assert('eb3115e5-bd16-4939-ab12-2b95745a30f3');
// → "eb3115e5-bd16-4939-ab12-2b95745a30f3" must be a valid UUID version 1

v::uuid(4)->assert('eb3115e5-bd16-4939-ab12-2b95745a30f3');
// Validation passes successfully

v::uuid(8)->assert('00112233-4455-8677-8899-aabbccddeeff');
// Validation passes successfully

v::uuid(4)->assert(\Ramsey\Uuid\Uuid::fromString('eb3115e5-bd16-4939-ab12-2b95745a30f3'));
// Validation passes successfully
```

## Templates

### `Uuid::TEMPLATE_STANDARD`

|       Mode | Template                             |
| ---------: | :----------------------------------- |
|  `default` | {{subject}} must be a valid UUID     |
| `inverted` | {{subject}} must not be a valid UUID |

### `Uuid::TEMPLATE_VERSION`

|       Mode | Template                                                          |
| ---------: | :---------------------------------------------------------------- |
|  `default` | {{subject}} must be a valid UUID version {{version&#124;raw}}     |
| `inverted` | {{subject}} must not be a valid UUID version {{version&#124;raw}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |
| `version`   | The version of the expected UUID.                                |

## Categorization

- Strings

## Changelog

| Version | Description            |
| ------: | :--------------------- |
|   3.0.0 | Requires `ramsey/uuid` |
|   2.0.0 | Created                |

## See Also

- [Base](Base.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
