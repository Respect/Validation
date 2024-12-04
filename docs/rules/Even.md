# Even

- `Even()`

Validates whether the input is an even number or not.

```php
v::intVal()->even()->isValid(2); // true
```

Using `int()` before `even()` is a best practice.

## Templates

`Even::TEMPLATE_STANDARD`

| Mode       | Template                        |
|------------|---------------------------------|
| `default`  | {{name}} must be an even number |
| `inverted` | {{name}} must be an odd number  |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers

## Changelog

| Version | Description |
|--------:|-------------|
|   0.3.9 | Created     |

***
See also:

- [Multiple](Multiple.md)
- [Odd](Odd.md)
