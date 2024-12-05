# UndefOr

- `UndefOr(Rule $rule)`

Validates the input using a defined rule when the input is not `null` or an empty string (`''`).

This rule can be particularly useful when validating form fields.

## Usage

```php
v::undefOr(v::alpha())->isValid(''); // true
v::undefOr(v::digit())->isValid(null); // true

v::undefOr(v::alpha())->isValid('username'); // true
v::undefOr(v::alpha())->isValid('has1number'); // false
```

## Prefix

For convenience, you can use the `undefOr` as a prefix to any rule:

```php
v::undefOrEmail()->isValid('not an email'); // false
v::undefOrBetween(1, 3)->isValid(2); // true
```

## Templates

| Id                          | Default              | Inverted                  |
|-----------------------------|----------------------|---------------------------|
| `NullOr::TEMPLATE_STANDARD` | or must be undefined | and must not be undefined |

The templates from this rule serve as message suffixes:

```php
v::undefOr(v::alpha())->assert('has1number');
// "has1number" must contain only letters (a-z) or must be undefined

v::not(v::undefOr(v::alpha()))->assert("alpha");
// "alpha" must not contain letters (a-z) and must not be undefined
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
|   3.0.0 | Renamed to `UndefOr`  |
|   1.0.0 | Created as `Optional` |

***
See also:

- [NoWhitespace](NoWhitespace.md)
- [NotBlank](NotBlank.md)
- [NotEmpty](NotEmpty.md)
- [NotUndef](NotUndef.md)
- [NullOr](NullOr.md)
- [NullType](NullType.md)
