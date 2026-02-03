<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
-->

# Each

- `Each(Validator $validator)`

Validates whether each value in the input is valid according to another validator.

```php
$releaseDates = [
    'validation' => '2010-01-01',
    'template'   => '2011-01-01',
    'relational' => '2011-02-05',
];

v::each(v::dateTime())->assert($releaseDates);
// Validation passes successfully
```

This validator is similar to [All](All.md), but while `All` displays a single message
generic to all failed entries, `Each` will display a message for each failed
entry instead.

```php
v::each(v::startsWith('2010'))->assert($releaseDates);
// → - Each item in `["validation": "2010-01-01", "template": "2011-01-01", "relational": "2011-02-05"]` must be valid
// →   - `.template` must start with "2010"
// →   - `.relational` must start with "2010"

v::named('Release Dates', v::each(v::startsWith('2010')))->assert($releaseDates);
// → - Each item in Release Dates must be valid
// →   - `.template` must start with "2010"
// →   - `.relational` must start with "2010"
```

You can also validate array keys combining this validator with [After](After.md):

```php
v::after('array_keys', v::each(v::stringType()))->assert($releaseDates);
// Validation passes successfully
```

## Note

This validator will pass if the input is empty. Use [Length](Length.md) with [GreaterThan][GreaterThan.md] to perform a stricter check:

```php
v::each(v::equals(10))->assert([]);
// Validation passes successfully

v::length(v::greaterThan(0))->each(v::equals(10))->assert([]);
// → The length of `[]` must be greater than 0
```

## Templates

### `Each::TEMPLATE_STANDARD`

|       Mode | Template                                 |
| ---------: | :--------------------------------------- |
|  `default` | Each item in {{subject}} must be valid   |
| `inverted` | Each item in {{subject}} must be invalid |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays
- Nesting
- Transformations

## Changelog

| Version | Description                        |
| ------: | :--------------------------------- |
|   3.0.0 | Rejected `stdClass`, non-iterables |
|   2.0.0 | Remove support for key validation  |
|   0.3.9 | Created                            |

## See Also

- [After](After.md)
- [All](All.md)
- [ArrayVal](ArrayVal.md)
- [Falsy](Falsy.md)
- [IterableType](IterableType.md)
- [IterableVal](IterableVal.md)
- [Key](Key.md)
- [KeyExists](KeyExists.md)
- [KeyOptional](KeyOptional.md)
- [Length](Length.md)
- [Min](Min.md)
- [Unique](Unique.md)
