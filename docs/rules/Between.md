# Between

- `Between(mixed $minimum, mixed $maximum)`

Validates whether the input is between two other values.

```php
v::intVal()->between(10, 20)->isValid(10); // true
v::intVal()->between(10, 20)->isValid(15); // true
v::intVal()->between(10, 20)->isValid(20); // true
```

Validation makes comparison easier, check out our supported
[comparable values](../08-comparable-values.md).

Message template for this validator includes `{{minValue}}` and `{{maxValue}}`.

## Templates

`Between::TEMPLATE_STANDARD`

| Mode       | Template                                                   |
|------------|------------------------------------------------------------|
| `default`  | {{name}} must be between {{minValue}} and {{maxValue}}     |
| `inverted` | {{name}} must not be between {{minValue}} and {{maxValue}} |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `maxValue`  | The minimum value passed to the rule.                            |
| `minValue`  | The maximum value passed to the rule.                            |
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Comparisons

## Changelog

| Version | Description                 |
|--------:|-----------------------------|
|   2.0.0 | Became always inclusive     |
|   1.0.0 | Became inclusive by default |
|   0.3.9 | Created                     |

***
See also:

- [BetweenExclusive](BetweenExclusive.md)
- [DateTime](DateTime.md)
- [GreaterThan](GreaterThan.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [Length](Length.md)
- [LessThan](LessThan.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
- [Min](Min.md)
