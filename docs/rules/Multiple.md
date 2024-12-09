# Multiple

- `Multiple(int $multipleOf)`

Validates if the input is a multiple of the given parameter

```php
v::intVal()->multiple(3)->isValid(9); // true
```

## Templates

### `Multiple::TEMPLATE_STANDARD`

| Mode       | Template                                          |
|------------|---------------------------------------------------|
| `default`  | {{name}} must be a multiple of {{multipleOf}}     |
| `inverted` | {{name}} must not be a multiple of {{multipleOf}} |

## Template placeholders

| Placeholder  | Description                                                      |
|--------------|------------------------------------------------------------------|
| `multipleOf` |                                                                  |
| `name`       | The validated input or the custom validator name (if specified). |

## Categorization

- Math
- Numbers

## Changelog

| Version | Description |
|--------:|-------------|
|   0.3.9 | Created     |

***
See also:

- [Even](Even.md)
- [Odd](Odd.md)
- [PrimeNumber](PrimeNumber.md)
