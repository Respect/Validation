# Uuid

- `Uuid()`
- `Uuid(int $version)`

Validates whether the input is a valid UUID. It also supports validation of
specific versions 1, 3, 4 and 5.

```php
v::uuid()->isValid('Hello World!'); // false
v::uuid()->isValid('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // true
v::uuid(1)->isValid('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // false
v::uuid(4)->isValid('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // true
```

## Templates

### `Uuid::TEMPLATE_STANDARD`

| Mode       | Template                          |
|------------|-----------------------------------|
| `default`  | {{name}} must be a valid UUID     |
| `inverted` | {{name}} must not be a valid UUID |

### `Uuid::TEMPLATE_VERSION`

| Mode       | Template                                                       |
|------------|----------------------------------------------------------------|
| `default`  | {{name}} must be a valid UUID version {{version&#124;raw}}     |
| `inverted` | {{name}} must not be a valid UUID version {{version&#124;raw}} |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |
| `version`   |                                                                  |

## Categorization

- Strings

## Changelog

| Version | Description |
|--------:|-------------|
|   2.0.0 | Created     |

***
See also:

- [Base](Base.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
