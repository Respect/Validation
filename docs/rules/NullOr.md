# NullOr

- `NullOr(Validatable $rule)`

Validates the input using a defined rule when the input is not `null`.

## Usage

```php
v::nullable(v::email())->isValid(null); // true
v::nullable(v::email())->isValid('example@example.com'); // true
v::nullable(v::email())->isValid('not an email'); // false
```

## Prefix

For convenience, you can use `nullOr` as a prefix to any rule:

```php
v::nullOrEmail()->isValid('not an email'); // false
v::nullOrBetween(1, 3)->isValid(2); // true
v::nullOrBetween(1, 3)->isValid(null); // true
```

## Templates

| Id                          | Default         | Inverted             |
|-----------------------------|-----------------|----------------------|
| `NullOr::TEMPLATE_STANDARD` | or must be null | and must not be null |

The templates from this rule serve as message suffixes:

```php
v::nullOr(v::alpha())->assert('has1number');
// "has1number" must contain only letters (a-z) or must be null

v::not(v::nullOr(v::alpha()))->assert("alpha");
// "alpha" must not contain letters (a-z) and must not be null
```

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Nesting

## Changelog

| Version | Description           |
|--------:|-----------------------|
|   3.0.0 | Renamed to `NullOr`   |
|   2.0.0 | Created as `Nullable` |

***
See also:

- [NullType](NullType.md)
- [UndefOr](UndefOr.md)
