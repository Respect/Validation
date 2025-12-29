# Each

- `Each(Rule $rule)`

Validates whether each value in the input is valid according to another rule.

```php
$releaseDates = [
    'validation' => '2010-01-01',
    'template'   => '2011-01-01',
    'relational' => '2011-02-05',
];

v::each(v::dateTime())->isValid($releaseDates); // true
```

You can also validate array keys combining this rule with [Call](Call.md):

```php
v::call('array_keys', v::each(v::stringType()))->isValid($releaseDates); // true
```

## Note

This rule uses [Length](Length.md) with [GreaterThan][GreaterThan.md] internally. If an input has no items, the validation will fail. 

## Templates

### `Each::TEMPLATE_STANDARD`

| Mode       | Template                                 |
| ---------- | ---------------------------------------- |
| `default`  | Each item in {{subject}} must be valid   |
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

| Version | Description                                                 |
| ------: | ----------------------------------------------------------- |
|   3.0.0 | Rejected `stdClass`, non-iterable. or empty iterable values |
|   2.0.0 | Remove support for key validation                           |
|   0.3.9 | Created                                                     |

---

See also:

- [ArrayVal](ArrayVal.md)
- [Call](Call.md)
- [Falsy](Falsy.md)
- [IterableType](IterableType.md)
- [IterableVal](IterableVal.md)
- [Key](Key.md)
- [KeyExists](KeyExists.md)
- [KeyOptional](KeyOptional.md)
- [Min](Min.md)
- [Unique](Unique.md)
