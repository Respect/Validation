# StartsWith

- `StartsWith(mixed $value)`
- `StartsWith(mixed $value, bool $identical)`

Validates whether the input starts with a given value.

This validator is similar to [Contains](Contains.md), but validates only
if the value is at the beginning of the input.

For strings:

```php
v::startsWith('lorem')->isValid('lorem ipsum'); // true
```

For arrays:

```php
v::startsWith('lorem')->isValid(['lorem', 'ipsum']); // true
```

`true` may be passed as a parameter to indicate identical comparison
instead of equal.

Message template for this validator includes `{{startValue}}`.

## Templates

`StartsWith::TEMPLATE_STANDARD`

| Mode       | Template                                    |
|------------|---------------------------------------------|
| `default`  | {{name}} must start with {{startValue}}     |
| `inverted` | {{name}} must not start with {{startValue}} |

## Template placeholders

| Placeholder  | Description                                                      |
|--------------|------------------------------------------------------------------|
| `name`       | The validated input or the custom validator name (if specified). |
| `startValue` |                                                                  |

## Categorization

- Arrays
- Strings

## Changelog

| Version | Description |
|--------:|-------------|
|   0.3.9 | Created     |

***
See also:

- [Contains](Contains.md)
- [EndsWith](EndsWith.md)
- [In](In.md)
- [Regex](Regex.md)
