<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# All

- `All(Validator $validator)`

Validates all items of the input against a given validator.

```php
$releaseDates = [
    'validation' => '2010-01-01',
    'template'   => '2011-01-01',
    'relational' => '2011-02-05',
];

v::all(v::dateTime())->assert($releaseDates);
// Validation passes successfully
```

This validator is similar to [Each](Each.md), but while `Each` displays a message for each of the failed entries, `All` will display a single message generic to all 
failed entries instead.

```php
v::all(v::startsWith('2010'))->assert($releaseDates);
// → Every item in `["validation": "2010-01-01", "template": "2011-01-01", "relational": "2011-02-05"]` must start with "2010"

v::named('Release Dates', v::all(v::startsWith('2010')))->assert($releaseDates);
// → Every item in Release Dates must start with "2010"
```
## Note

This validator will pass if the input is empty. Use [Length](Length.md) with [GreaterThan][GreaterThan.md] to perform a stricter check:

```php
v::all(v::equals(10))->assert([]);
// Validation passes successfully

v::length(v::greaterThan(0))->all(v::equals(10))->assert([]);
// → The length of `[]` must be greater than 0
```

## Templates

### `All::TEMPLATE_STANDARD`

|       Mode | Template      |
| ---------: | :------------ |
|  `default` | Every item in |
| `inverted` | Every item in |

## Template as prefix

The template serves as a prefix to the template of the inner validator.

```php
v::all(v::floatType())->assert([1.5, 2]);
// → Every item in `[1.5, 2]` must be float

v::not(v::all(v::intType()))->assert([1, 2, -3]);
// → Every item in `[1, 2, -3]` must not be an integer
```

## Categorization

- Comparisons
- Transformations

## Changelog

| Version | Description |
| ------: | :---------- |
|   3.0.0 | Created     |

## See Also

- [Each](Each.md)
- [Length](Length.md)
- [Max](Max.md)
- [Min](Min.md)
