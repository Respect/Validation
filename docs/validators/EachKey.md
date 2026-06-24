<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# EachKey

- `EachKey(Validator $validator)`

Validates whether each key in the input is valid according to another validator.

```php
$releaseDates = [
    'validation' => '2010-01-01',
    'template'   => '2011-01-01',
    'relational' => '2011-02-05',
];

v::eachKey(v::stringType())->assert($releaseDates);
// Validation passes successfully
```

This validator is the key-type counterpart to [Each](Each.md). While `Each` validates
values, `EachKey` validates keys. This allows composable validation of array key types:

```php
v::eachKey(v::stringType())->assert(['a' => 1, 'b' => 2]);
// Validation passes successfully

v::eachKey(v::stringType())->assert([0 => 'x', 1 => 'y']);
// → - Each key of `["x", "y"]` must be valid
// →   - Key `.0` must be a string
// →   - Key `.1` must be a string
```

You can combine `EachKey` with [Each](Each.md) via [AllOf](AllOf.md) to validate both
keys and values independently:

```php
v::allOf(v::eachKey(v::stringType()), v::each(v::intType()))->assert(['a' => 1, 'b' => 2]);
// Validation passes successfully
```

## Note

This validator will pass if the input is empty. Use [Length](Length.md) with [GreaterThan](GreaterThan.md) to perform a stricter check:

```php
v::eachKey(v::stringType())->assert([]);
// Validation passes successfully

v::length(v::greaterThan(0))->eachKey(v::stringType())->assert([]);
// → The length of `[]` must be greater than 0
```

## Templates

### `EachKey::TEMPLATE_STANDARD`

|       Mode | Template                                |
| ---------: | :-------------------------------------- |
|  `default` | Each key of {{subject}} must be valid   |
| `inverted` | Each key of {{subject}} must be invalid |

### `EachKey::TEMPLATE_NESTED`

|       Mode | Template |
| ---------: | :------- |
|  `default` | Key      |
| `inverted` | Key      |

### `EachKey::TEMPLATE_SHORT_CIRCUITED`

|       Mode | Template    |
| ---------: | :---------- |
|  `default` | Each key of |
| `inverted` | Each key of |

## Template placeholders

- **TEMPLATE_STANDARD**: Uses `{{subject}}` — the validated input or the custom
  validator name (if specified).
- **TEMPLATE_NESTED**: Does not use placeholders. Composes with the inner
  validator's template via `asAdjacentOf` to produce messages like
  "Key `.0` must be a string".

## Categorization

- Arrays
- Nesting

## Changelog

| Version | Description |
| ------: | :---------- |
|   3.2.0 | Created     |

## See Also

- [After](After.md)
- [All](All.md)
- [AllOf](AllOf.md)
- [Each](Each.md)
- [IterableType](IterableType.md)
- [IterableVal](IterableVal.md)
- [Key](Key.md)
- [KeyExists](KeyExists.md)
- [KeyOptional](KeyOptional.md)
- [KeySet](KeySet.md)
- [Length](Length.md)
