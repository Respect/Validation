# Base

- `Base(string $base)`

Validate numbers in any base, even with non regular bases.

```php
v::base(2)->isValid('011010001'); // true
v::base(3)->isValid('0120122001'); // true
v::base(8)->isValid('01234567520'); // true
v::base(16)->isValid('012a34f5675c20d'); // true
v::base(2)->isValid('0120122001'); // false
```

## Templates

`Base::TEMPLATE_STANDARD`

| Mode       | Template                                                |
|------------|---------------------------------------------------------|
| `default`  | {{name}} must be a number in base {{base&#124;raw}}     |
| `inverted` | {{name}} must not be a number in base {{base&#124;raw}} |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `base`      | The base passed to the constructor of the rule.                  |
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers

## Changelog

| Version | Description |
|--------:|-------------|
|   0.5.0 | Created     |

***
See also:

- [Base64](Base64.md)
- [Uuid](Uuid.md)
