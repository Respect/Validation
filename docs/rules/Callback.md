# Callback

- `Callback(callable $callback)`

Validates the input using the return of a given callable.

```php
v::callback(
    function (int $input): bool {
        return $input + ($input / 2) == 15;
    }
)->isValid(10); // true
```

## Templates

`Callback::TEMPLATE_STANDARD`

| Mode       | Template                 |
|------------|--------------------------|
| `default`  | {{name}} must be valid   |
| `inverted` | {{name}} must be invalid |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Callables

## Changelog

| Version | Description |
|--------:|-------------|
|   0.3.9 | Created     |

***
See also:

- [Call](Call.md)
- [CallableType](CallableType.md)
- [DateTime](DateTime.md)
- [FilterVar](FilterVar.md)
