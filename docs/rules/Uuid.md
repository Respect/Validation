# Uuid

- `Uuid()`
- `Uuid(int $version)`

Validates whether the input is a valid UUID. It also supports validation of
specific versions 1 to 8.

```php
v::uuid()->isValid('Hello World!'); // false
v::uuid()->isValid('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // true
v::uuid()->isValid('eb3115e5bd164939ab122b95745a30f3'); // true
v::uuid(1)->isValid('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // false
v::uuid(4)->isValid('eb3115e5-bd16-4939-ab12-2b95745a30f3'); // true
v::uuid(8)->isValid('00112233-4455-8677-8899-aabbccddeeff'); // true
v::uuid(4)->isValid(new \Ramsey\Uuid\Uuid::fromString('eb3115e5-bd16-4939-ab12-2b95745a30f3')); // true
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
| `version`   | The version of the expected UUID.                                |

## Categorization

- Strings

## Changelog

| Version | Description            |
|--------:|------------------------|
|   3.0.0 | Requires `ramsey/uuid` |
|   2.0.0 | Created                |

***
See also:

- [Base](Base.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
