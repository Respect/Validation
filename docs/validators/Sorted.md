<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Sorted

- `Sorted(string $direction)`

Validates whether the input is sorted in a certain order or not.

```php
v::sorted('ASC')->assert([1, 2, 3]);
// Validation passes successfully

v::sorted('ASC')->assert('ABC');
// Validation passes successfully

v::sorted('DESC')->assert([3, 2, 1]);
// Validation passes successfully

v::sorted('ASC')->assert([]);
// Validation passes successfully

v::sorted('ASC')->assert([1]);
// Validation passes successfully
```

You can also combine [Call](Call.md) to create custom validations:

```php
v::call(
        fn (array $input): array  => array_column($input, 'key'),
        v::sorted('ASC')
    )->assert([
        ['key' => 1],
        ['key' => 5],
        ['key' => 9],
    ]);
// Validation passes successfully

v::call('strval', v::sorted('DESC'))->assert(4321);
// Validation passes successfully

v::call('iterator_to_array', v::sorted('ASC'))->assert(new ArrayIterator([1, 7, 4]));
// → `[1, 7, 4]` must be sorted in ascending order
```

## Templates

### `Sorted::TEMPLATE_ASCENDING`

|       Mode | Template                                          |
| ---------: | :------------------------------------------------ |
|  `default` | {{subject}} must be sorted in ascending order     |
| `inverted` | {{subject}} must not be sorted in ascending order |

### `Sorted::TEMPLATE_DESCENDING`

|       Mode | Template                                           |
| ---------: | :------------------------------------------------- |
|  `default` | {{subject}} must be sorted in descending order     |
| `inverted` | {{subject}} must not be sorted in descending order |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays
- Strings

## Changelog

| Version | Description                                    |
| ------: | :--------------------------------------------- |
|   2.0.0 | Add support for strings                        |
|   2.0.0 | Do not use array keys to sort                  |
|   2.0.0 | Use sorting direction instead of boolean value |
|   2.0.0 | Do not accept callback in the constructor      |
|   1.1.1 | Created                                        |

## See Also

- [ArrayVal](ArrayVal.md)
- [Call](Call.md)
